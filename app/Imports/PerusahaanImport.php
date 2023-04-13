<?php

namespace App\Imports;

use App\Models\CategoryPT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new CategoryPT([
            'nama'                 => $row['nama'],
            'alamat'               => $row['alamat'],
            'no_telp_kantor'       => $row['contact'],
            'website'              => $row['website'],
            'nama_pic'             => $row['pic'],
            'no_telp_pic'          => $row['contact_pic'],
            'email'                => $row['email'],
            'npwp_perusahaan'      => $row['npwp'],
            'pkp'                  => $row['pkp'],
            'nib'                  => $row['nib'],
            'bidang_usaha'         => $row['bidang'],
            'no_rekening'          => $row['no_rekening'],
            'bank'                 => $row['bank'],
            'cabang_bank'          => $row['bank_branch'],
            'nama_penerima'        => $row['nama_penerima']
        ]);
    }
}
