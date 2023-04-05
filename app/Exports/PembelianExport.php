<?php

namespace App\Exports;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\ItemPO;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;

class PembelianExport implements FromView ,WithColumnWidths
{
     // RETURN VIEWS
     public function view(): View
     {
         $data['category_ppb']  = CategoryPengajuanPembelian::where('status','Paid')->get();
        //  $data['po']            = CategoryPO::groupBy('ppb_id')->get();
         $data['itempo']        = ItemPO::groupBy('po_id')->get();
         return view('exports.barang', $data);
     }
     public function columnWidths(): array
    {
        return [
            'A'   => 10,
            'B'   => 10,
            'C'   => 10,
            'D'   => 10,
            'E'   => 10,
            'F'   => 10,
            'G'   => 10,
            'H'   => 10,
            'I'   => 10,
            'J'   => 10,
            'K'   => 10,
            'L'   => 10,
            'M'   => 10,
            'N'   => 10,
            'O'   => 10,
            'P'   => 10,
            'Q'   => 10,
        ];
    }

}
