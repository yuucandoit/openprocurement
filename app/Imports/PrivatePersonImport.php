<?php

namespace App\Imports;

use App\Models\CategoryPP;
use App\Models\PrivatePerson;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class PrivatePersonImport implements ToModel
{

    public function model(array $row)
    {
        return new CategoryPP([
            'nama'      => $row[0],
            'alamat'    => $row[1],
            'nik'       => $row[2],
            'npwp_pp'   => $row[3],
            'pkp'       => $row[4],
        ]);
    }
}
