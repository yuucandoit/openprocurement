<?php

namespace App\Imports;

use App\Models\Uom;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UomImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
  {
    return new Uom([
        'name'  =>  $row['name'],
    ]);
  }
}
