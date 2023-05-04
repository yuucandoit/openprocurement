<?php

namespace App\Imports;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\ItemPO;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Validators\Failure;

class PengajuanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
        // dd($row[12]);
        if (empty($row[12])){
            $ws = 3;
            $department = 11;
        }
        elseif(strpos($row[12], 'Badrul') !== false){
            $ws = 34;
            $department = 16;

        } elseif(strpos($row[12], 'Latief') !== false){
            $ws = 36;
            $department = 18;
        } elseif(strpos($row[12], 'Edward') !== false) {
            $ws = 40;
            $department = 11;
        }

        if (empty($row[5])){
            $matauang = 'RP';
        }elseif(strpos($row[5], '$') !== false) {
            $matauang = 'USD';
        } elseif(strpos($row[5], 'RP') !== false){
            $matauang = 'RP';
        }

        if (empty($row[10])){
            $project = 108;
        }elseif(strpos($row[10],'Molis') !== false){
            $project = 103;
        } elseif(strpos($row[10],'Riset Phone Bank') !== false){
            $project = 105;
        } elseif(strpos($row[10],'NEXTG') !== false){
            $project = 99;
        }

        if(empty($row[1])){
            $item = "-";
        } else{
            $item = $row[1];
        }
        if(empty($row[3])){
            $qty = 0;
        }else {
            $qty = $row[3];
        }
        if(empty($row[4])){
            $unit = "Pcs";
        } else {
            $unit = $row[4];
        }

        if(empty($row[5])) {
            $price = 0;
        } else{
            $price = $row[5];
        }

        if(empty($row[6])){
            $total = 0;
        } else {
            $total = $row[6];
        }
        // dd($row);

       $ppb = CategoryPengajuanPembelian::create([
            'status'        => 'Khusus',
            'atasan'        => 3,
            'atasan_po'     => 3,
            'atasan_py'     => 3,
            'ws'            => $ws,
            'department'    => $department,
            'purpose_type'  => '\App\Models\ReferensiNamaProject',
            'purpose_id'    =>  $project,
            'date_ps'       => now(),
            'send_to'       => 'Cikunir',
            'dateline'      => '-',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);


        $po = CategoryPO::create([
            'ppb_id'            => $ppb->id,
            'term_conditions'   => 2,
            'vendorable_type'   => '\App\Models\CategoryEcommerce',
            'vendorable_id'     => 6,
            'quotation'         => '-',
            'created_at'        => now(),
            'updated_at'        => now(),
            'item_ppid'         => 0
        ]);
        // dd($row);

        ItemPO::create([
            'ppb_id'            => $ppb->id,
            'po_id'             => $po->id,
            'item'              => $item,
            'qty'               => $qty,
            'kategori'          => $unit,
            'unit_price'        => $price,
            'matauang'          => $matauang,
            'dpp'               => $total,
            'grand_total'       => $total,
        ]);
        }
    }

    public function chunkSize(): int
    {
        return 115;
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $row = $failure->row(); // nomor baris yang gagal
            $errors = $failure->errors(); // array pesan error

            // lakukan sesuatu untuk menangani kesalahan pada baris ini
        }
    }
}
