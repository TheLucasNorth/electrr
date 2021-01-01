<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{

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
                $withdrawnCandidates[] = '-'.array_key_last($useableCandidates);
            }
        }
        unset($useableCandidates[0]);
        // after candidates are retrieved, sorted by ID, they are put into a new array. If RON is enabled for the role, it is added to the beginning of the array.
        // A placeholder is added and then removed at the beginning of the array so that the array starts at 1 - this is needed for counting the results.
        // At the same time, an array is formed for all withdrawn candidates. This array will hold the key for that candidate, as determined by that candidates key in the useableCandidates array, preceded by a minus sign.
        $output = [];
        // begin crafting the output
        $output[] = count($useableCandidates).' '.$role->seats.' # Number of candidates and number of seats to be elected';
        $output[] = "# Withdrawn candidates. If none are listed, no candidates were withdrawn at the time of counting results.";
        $output[] = implode(' ', $withdrawnCandidates);
        $output[] = "# Votes, expressed as a 1 to start each line, the candidates in preference order, and a 0 to end each line.";
        $output[] = "# Each line also contains the 32 character random verification code, generated when the ballot was cast.";
        foreach ($ballots as $ballot) {
            $output[] = decrypt($ballot->vote);
        }
        $output[] = "0 # End of ballots is marked by a single line containing a zero.";
        $output[] = "# Candidate names, in database order.";
        foreach ($useableCandidates as $candidate) {
            $output[] = "\"$candidate\"";
        }
        $output[] = "\"$election->name : $role->name\" # The name of the election and role being counted.";
        return implode("\n", $output);
    }

    public function download(Election $election, Role $role) {
        $this->election = $election;
        $this->role = $role;
        return response()->streamDownload(function () {
            echo $this->generate($this->election, $this->role);
        }, $election->name.' - '.$role->name.'.blt');
    }

    public function calculate(Election $election, Role $role, $method) {
        $this->election = $election;
        $this->role = $role;
        return response()->streamDownload(function () {
            echo $this->generate($this->election, $this->role);
        }, $election->name.' - '.$role->name.'.blt');
    }

    public function apiGenerate(Request $request, Election $election, Role $role) {
        if (!$request->user()->tokenCan('results')) {
            return response()->json(['message' => 'not authorised'], 401);
        }

        return $this->generate($election, $role);

    }

}
