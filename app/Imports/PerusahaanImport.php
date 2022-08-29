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
            'nama'                 => $row['Nama'] ?? $row['nama perusahaan'] ?? $row['Nama Perusahaan'] ?? null,
            'alamat'               => $row['Alamat'] ?? $row['alamat'] ?? ['AlaMat'] ?? null,
            'no_telp_kantor'       => $row['Contact Kantor'] ?? $row['Contact_Kantor'] ?? $row['contact kantor'] ?? null,
            'website'              => $row['Website'] ?? $row['web'] ?? null,
            'nama_pic'             => $row['nama_pic'] ?? $row['Nama PIC'] ?? $row['nama pic'] ?? null,
            'no_telp_pic'          => $row['Contact PIC'] ?? $row['contact pic'] ?? $row['Contact_PIC'] ?? null,
            'email'                => $row['Email'] ?? $row['email'] ?? null,
            'npwp_perusahaan'      => $row['NPWP PT'] ?? $row['NPWP_PT'] ?? $row['npwp_pt'] ,
            'pkp'                  => $row['PKP - NON-PKP'] ?? $row['pkp - non-pkp'] ?? $row[''],
            'nib'                  => $row[9],
            'bidang_usaha'         => $row[10],
            'no_rekening'          => $row[11],
            'bank'                 => $row[12],
            'cabang_bank'          => $row[13],
            'nama_penerima'        => $row[14]
        ]);
    }
}
