<?php

namespace App\Imports;

use App\Models\ReferensiNamaProject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ReferensiNamaProject([
            'id'      => $row['no'],
            'name'      => $row['name'],
        ]);
    }
}
