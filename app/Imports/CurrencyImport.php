<?php

namespace App\Imports;

use App\Models\Currency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CurrencyImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
  {
    // dd($row);
    return new Currency([
        'name'          =>  $row['currency'],
        'code'         =>  $row['code'],
    ]);
  }
}
