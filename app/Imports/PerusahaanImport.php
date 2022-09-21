<?php

namespace App\Imports;

use App\Models\CategoryPT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class PerusahaanImport implements ToModel
{
    public function model(array $row)
    {
        return new CategoryPT([
            'nama'                 => $row[0],
            'alamat'               => $row[1],
            'no_telp_kantor'       => $row[2],
            'website'              => $row[3],
            'nama_pic'             => $row[4],
            'no_telp_pic'          => $row[5],
            'email'                => $row[6],
            'npwp_perusahaan'      => $row[7],
            'pkp'                  => $row[8],
            'nib'                  => $row[9],
            'bidang_usaha'         => $row[10],
            'no_rekening'          => $row[11],
            'bank'                 => $row[12],
            'cabang_bank'          => $row[13],
            'nama_penerima'        => $row[14]
        ]);
    }
}
