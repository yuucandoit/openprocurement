<?php

namespace App\Exports;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\POSignature;
use App\Models\ReferensiNamaProject;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DBPurchaseHistoryExport implements FromView
{
    protected $purposeId;
    protected $purposeType;

    public function __construct($purposeId = null, $purposeType = null)
    {
        $this->purposeId = $purposeId;
        // $this->purposeType = $purposeType;
    }



    public function view(): View
     {
        if ($this->purposeId) {
            // Jika ada parameter purpose_id dan purpose_type
            $data['ppb_id'] = CategoryPengajuanPembelian::with(['quot', 'quot.itempo', 'quot.vendorable', 'itemppn'])
                ->where('purpose_type', ReferensiNamaProject::class)
                ->where('purpose_id', $this->purposeId)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            // Jika tidak ada parameter purpose_id dan purpose_type
            $data['ppb_id'] = CategoryPengajuanPembelian::with(['quot', 'quot.itempo', 'quot.vendorable', 'itemppn'])
                ->whereIn('status', [
                    'Purchase Proses', 'Cross Check PO', 'Waiting For PO Approval', 'PO Approved',
                    'Invoicing Process', 'Payment Approved', 'Unpaid', 'Paid', 'Delivery Process',
                    'Delivery Success', 'PO Rejected by BOD', 'Rejected by Purchasing', 'Payment Rejected By BOD',
                    'Rejected by Finance', 'PO & Payment Approved'
                ])
                ->orderBy('created_at', 'DESC')
                ->limit(1000)
                ->get();
        }

        // $data['ppb_id'] = CategoryPengajuanPembelian::with(['quot', 'quot.itempo', 'quot.vendorable', 'itemppn'])->whereIn('status',['Purchase Proses','Cross Check PO',
        // 'Waiting For PO Approval','PO Approved','Invoicing Process','Payment Approved','Unpaid','Paid',
        // 'Delivery Process','Delivery Success','PO Rejected by BOD','Rejected by Purchasing',
        // 'Payment Rejected By BOD','Rejected by Finance','PO & Payment Approved'])->orderBy('created_at','DESC')->limit(1000)->get();

         return view('exports.purchase_history', $data);
     }
}
