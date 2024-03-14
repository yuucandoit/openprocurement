<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pre_pr;
use App\Models\PartItem_Pre_pr;

class PrePRExport implements FromView
{
    public function __construct($convertID)
    {
        $this->convertID = $convertID;
    }


   public function view(): View
    {
        $data['prepr'] = Pre_pr::findOrFail($this->convertID);
        $data['item'] = PartItem_Pre_pr::where('pre_pr_id',$this->convertID)->get();

        return view('exports.prepr', $data);
    }
}
