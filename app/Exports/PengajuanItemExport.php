<?php

namespace App\Exports;

use App\Models\PengajuanPembelian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class PengajuanItemExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('exports.itempengajuanpembelian',[
            'product_stock' => PengajuanPembelian::all()
        ]);
    }

}
