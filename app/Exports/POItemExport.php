<?php

namespace App\Exports;

use App\Models\ItemPO;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class POItemExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('exports.itempurchaseorder',[
            'product_stock' => ItemPO::all()
        ]);
    }
}
