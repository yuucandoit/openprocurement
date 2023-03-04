<?php

namespace App\Imports;

use App\Models\Bank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
  {
    // dd($row);
    return new Bank([
        'name'          =>  $row['name'],
        'alamaat'       =>  $row['alamat'],
        'call_center'   =>  $row['call_center'],
    ]);
  }
}
