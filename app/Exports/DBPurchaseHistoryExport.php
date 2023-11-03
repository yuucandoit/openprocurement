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

        $data['ppb_id'] = CategoryPengajuanPembelian::whereIn('status',['Purchase Proses','Cross Check PO',
        'Waiting For PO Approval','PO Approved','Invoicing Process','Payment Approved','Unpaid','Paid',
        'Delivery Process','Delivery Success','PO Rejected by BOD','Rejected by Purchasing',
        'Payment Rejected By BOD','Rejected by Finance','PO & Payment Approved'])->orderBy('created_at','DESC')->limit(1000)->get();

        $data['po'] = CategoryPO::whereHas('ppb',function($q){
            $q->orderBy('created_at','desc')->whereIn('status',['Purchase Proses','Cross Check PO',
            'Waiting For PO Approval','PO Approved','Invoicing Process','Payment Approved','Unpaid','Paid',
            'Delivery Process','Delivery Success','PO Rejected by BOD','Rejected by Purchasing',
            'Payment Rejected By BOD','Rejected by Finance','PO & Payment Approved']);
            })->orderBy('created_at','DESC')->get();
         $data['itempo']  = ItemPO::groupBy('po_id')->get();
         $data['sig']   = POSignature::get();
         return view('exports.purchase_history', $data);
     }
}
