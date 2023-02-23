<?php

namespace App\Imports;

use App\Models\ItemHistory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemHistoryImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    // dd($row);
    return new ItemHistory([
        'item'          =>  $row['item'],
        'kategori'      =>  $row['category'],
        'qty'           =>  $row['qty'],
        'unit_price'    =>  $row['harga'],
        'total'         =>  $row['total'],
        'discount'      =>  $row['discount'] ?? 0 ?? null,
        'dpp'           =>  $row['dpp'] ?? 0 ?? null,
        'ongkir'        =>  $row['ongkir'] ?? 0 ?? null,
        'admin_fee'     =>  $row['admin_fee'] ?? 0 ?? null,
        'matauang'      =>  $row['matauang'] ?? 'RP'?? null,
        'ppn'           =>  $row['ppn'] ?? 0 ?? null,
        'grand_total'   =>  $row['grandtotal'] ?? 0 ?? null,
    ]);
  }
}
