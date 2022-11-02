<?php

namespace Database\Seeders;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPT::create([
        'nama'                  => 'PT Solusi Intek Indonesia',
        'alamat'                => 'Tebet Jakarta Selatan DKI Jakarta 12343',
        'no_telp_kantor'        => '081282711114',
        'website'               => 'https://intek.co.id/home/',
        'nama_pic'              => 'Victor',
        'no_telp_pic'           => '0812132350',
        'email'                 => 'SolusiIntek@gmail.com',
        'npwp_perusahaan'       => '123123123123',
        'pkp'                   => 'PKP',
        'nib'                   => '00000001',
        'bidang_usaha'          => 'Teknologi',
        'no_rekening'           => '3123812012321',
        'bank'                  => 'BCA(014)',
        'cabang_bank'           => 'BCA Jakarta Selatan',
        'nama_penerima'         => 'Badrul'
        ]);

        CategoryPT::create([
        'nama'                  => 'PT Jaya Pirata',
        'alamat'                => 'Tebet Jakarta Selatan DKI Jakarta 12343',
        'no_telp_kantor'        => '081282711114',
        'website'               => 'https://intek.co.id/home/',
        'nama_pic'              => 'Megandi',
        'no_telp_pic'           => '081232312812',
        'email'                 => 'Intiva@gmail.com',
        'npwp_perusahaan'       => '123123123123',
        'pkp'                   => 'PKP',
        'nib'                   => '000001201',
        'bidang_usaha'          => 'Teknologi',
        'no_rekening'           => '3123812012321',
        'bank'                  => 'BCA(014)',
        'cabang_bank'           => 'BCA Jakarta Selatan',
        'nama_penerima'         => 'Megandi'
        ]);

        CategoryPP::create([
            'nama'                  => 'Tatang Suhendro',
            'alamat'                => 'Cawang Jakarta Selatan DKI Jakarta 12345',
            'nik'                   => '3172021421018840',
            'npwp_pp'               => '123456712345678',
            'pkp'                   => 'PKP',
        ]);

        CategoryPP::create([
            'nama'                  => 'Maman Sudrajat',
            'alamat'                => 'Kalibata Jakarta Selatan DKI Jakarta 12342',
            'nik'                   => '3201120012351212',
            'npwp_pp'               => '22114455101224',
            'pkp'                   => 'Non-PKP',
        ]);

        CategoryEcommerce::create([
            'nama'                  => 'Tokopedia',
            'link'                  => 'https://tokopedia.com',
        ]);

        CategoryEcommerce::create([
            'nama'                  => 'Shopee',
            'link'                  => 'https://shopee.co.id',
        ]);

    }
}
