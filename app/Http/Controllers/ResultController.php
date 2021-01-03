<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{
    /**
     * @param Election $election
     * @param Role $role
     * @return string
     */
    public function generate(Election $election, Role $role)
    {
        // begin the generation of results. Aims: collect all votes for the role, process them into a .blt file format, and return the contents of the file
        $ballots = $role->votes;
        // retrieved all ballots for the role, with both the vote and the verification code encrypted
        $candidates = $role->candidates()->where('approved', true)->orderBy('order', 'asc')->get();
        // retrieve all candidates in the election, sorted by ID
        $withdrawnCandidates = [];
        $useableCandidates[0] = 'placeholder';
        if ($role->ron) {
            $useableCandidates[] = "Reopen Nominations";
        }
        foreach ($candidates as $candidate) {
            $useableCandidates[] = $candidate->name;
            if ($candidate->withdrawn) {
                $withdrawnCandidates[] = '-' . array_key_last($useableCandidates);
            }
        }
        unset($useableCandidates[0]);
        // after candidates are retrieved, sorted by ID, they are put into a new array. If RON is enabled for the role, it is added to the beginning of the array.
        // A placeholder is added and then removed at the beginning of the array so that the array starts at 1 - this is needed for counting the results.
        // At the same time, an array is formed for all withdrawn candidates. This array will hold the key for that candidate, as determined by that candidates key in the useableCandidates array, preceded by a minus sign.
        $output = [];
        // begin crafting the output
        $output[] = count($useableCandidates) . ' ' . $role->seats . ' # Number of candidates and number of seats to be elected';
        $output[] = "# Withdrawn candidates. If none are listed, no candidates were withdrawn at the time of counting results.";
        $output[] = implode(' ', $withdrawnCandidates);
        $output[] = "# Votes, expressed as a 1 to start each line, the candidates in preference order, and a 0 to end each line.";
        $output[] = "# Each line also contains the 32 character random verification code, generated when the ballot was cast.";
        foreach ($ballots as $ballot) {
            $output[] = decrypt($ballot->vote);
        }
        // votes are encrypted at storage and must be decrypted. Votes are stored in the format they must appear on the ballot.
        $output[] = "0 # End of ballots is marked by a single line containing a zero.";
        $output[] = "# Candidate names, in database order.";
        foreach ($useableCandidates as $candidate) {
            $output[] = "\"$candidate\"";
        }
        $output[] = "\"$election->name : $role->name\" # The name of the election and role being counted.";
        // all lines of the blt have now been generated, and the output array holds each line in an item. Implode the array with the newline character to return a useful format.
        return implode("\n", $output);
    }


    /**
     * @param Election $election
     * @param Role $role
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     * Returns the blt format result as a downloadable file
     */
    public function download(Election $election, Role $role)
    {
        $this->election = $election;
        $this->role = $role;
        return response()->streamDownload(function () {
            echo $this->generate($this->election, $this->role);
        }, $election->name . ' - ' . $role->name . '.blt');
    }

    /**
     * @param Election $election
     * @param Role $role
     * @param $method
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function display(Election $election, Role $role, $method)
    {
        return view('dashboard.results')->with('election', $election)->with('role', $role)->with('method', $method);
    }

    /**
     * @param Request $request
     * @param Election $election
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function apiGenerate(Request $request, Election $election, Role $role)
    {
        if (!$request->user()->tokenCan('results')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        return $this->generate($election, $role);
    }

    /**
     * @param Request $request
     * @param Election $election
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function apiCalculate(Request $request, Election $election, Role $role, $method)
    {
        if (!$request->user()->tokenCan('results')) {
            return response()->json(['message' => 'not authorised'], 401);
        }
        return $this->calculate($election, $role, $method);
    }


    // OPTIONS for calculating results. Please read the documentation, choose a method, and un-comment that method

    /**
     * LOCAL method - use a locally stored version of openstv to count results.
     * Please be aware that calling python in this way may expose a security vulnerability, you should make yourself comfortable with the PHP exec() command before using
     * @param Election $election
     * @param Role $role
     * @param $method
     * @return string
     */
    /*
    public function calculate(Election $election, Role $role, $method) {
        $filename = $election->name.'-'.$role->name.now().'.blt';
        Storage::put($filename, $this->generate($election, $role));
        $command = escapeshellcmd('python3 runElection.py -r HtmlReport '.$method.' "'.storage_path('app').'/'.$filename.'"');
        exec($command, $results);
        Storage::delete($filename);
        return implode($results);
    }
    */

    /**
     * REMOTE method - use a remote function to calculate results
     * @param Election $election
     * @param Role $role
     * @param $method
     * @return string
     */
    /*
    public function calculate(Election $election, Role $role, $method) {
        $filename = $election->name.'-'.$role->name.now().'.blt';
        Storage::put($filename, $this->generate($election, $role));
        $endpoint = "YOUR ENDPOINT HERE";
        $file = Storage::url($filename);
        $client = new Client();
        $response = $client->request('GET', $endpoint, ['query' => [
            'file' => $file,
            'method' => $method
        ]]);
        Storage::delete($filename);
        return $response;
    }
    */

    /**
     * OpaVote method - use OpaVote to count results
     * Please note that extra configuration is needed to use this method
     * @param Election $election
     * @param Role $role
     * @param $method
     * @return string
     */
    /*
    public function calculate(Election $election, Role $role, $method)
    {
        $method = $this->changeMethod($method);
        $blt = $this->generate($election, $role);
        $client = new Client();
        $endpoint = "https://www.opavote.com/api/v1/counts";
        $api = "YOUR OPAVOTE API KEY";
        $request = array("method" => $method, "blt" => $blt);
        $response = $client->request('POST', $endpoint, [
            'headers' => [
                'x-api-key' => $api,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($request)
        ]);
        return $response->getBody()->getContents();
    }

    public function changeMethod($method)
    {
        if ($method === "Approval") {
            return "Approval Voting";
        }
        if ($method === "Borda") {
            return "Borda Count";
        }
        if ($method === "Bucklin") {
            return "Bucklin System";
        }
        if ($method === "CambridgeSTV") {
            return "Cambridge STV (Massachusetts, USA)";
        }
        if ($method === "Coombs") {
            return "Coombs Method";
        }
        if ($method === "ERS97STV") {
            return "ERS97 STV";
        }
        if ($method === "GPCA2000STV") {
            return "Green Party of California STV";
        }
        if ($method === "IRV") {
            return "Instant Runoff Voting";
        }
        if ($method === "MeekSTV") {
            return "Meek STV";
        }
        if ($method === "MinneapolisSTV") {
            return "Minneapolis STV";
        }
        if ($method === "NIrelandSTV") {
            return "N. Ireland STV";
        }
        if ($method === "SanFranciscoRCV") {
            return "San Francisco RCV";
        }
        if ($method === "ScottishSTV") {
            return "Scottish STV";
        }
        if ($method === "WarrenSTV") {
            return "Warren STV";
        }
    }
    */
}

