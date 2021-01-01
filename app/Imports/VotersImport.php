<?php

namespace App\Imports;

use App\Models\Voter;
use Maatwebsite\Excel\Concerns\ToArray;

class VotersImport implements ToArray
{
    public function array(array $array)
    {
        return array_filter(filter_var_array($array, FILTER_VALIDATE_EMAIL));

    }
}
