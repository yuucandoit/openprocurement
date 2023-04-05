<?php

namespace App\Exports;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\POSignature;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DBPurchaseHistoryExport implements FromView
{
    public function view(): View
     {
         $data['category_ppb']  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')
         ->orWhere('status', 'PO Approved')
         ->orWhere('status', 'Invoicing Process')->orWhere('status', 'Payment Approved')
         ->orWhere('status', 'Unpaid')->orWhere('status', 'Paid')->orWhere('status', 'Delivery Process')
         ->orWhere('status','Delivery Success')->orWhere('status','PO Rejected by BOD')->orWhere('status','Rejected by Purchasing')->orWhere('status','Payment Rejected By BOD')
         ->orWhere('status','Rejected by Finance')->orderBy('created_at','DESC')->get();
        //  $data['po']            = CategoryPO::groupBy('ppb_id')->get();
         $data['itempo']        = ItemPO::groupBy('po_id')->get();
         $data['sig']           = POSignature::get();
         return view('exports.purchase_history', $data);
     }
}
