<?php

namespace App\Exports;

use App\Models\CategoryDV;
use App\Models\DataVendor;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class DvExport implements ShouldAutoSize, FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
     // RETURN VIEWS

     public function __construct($id)
     {
         $this->id = $id;
     }

     public function view(): View
     {
         $data['data_vendor'] = DataVendor::where('dv_id', $this->id)->get();
         $data['dv'] = DataVendor::where('id', $this->id)->first();
         $data['category_dv'] = CategoryDV::where('id', $this->id)->first();
         $data['year'] = Carbon::now()->format('y');
         $data['month'] = Carbon::now()->format('m');
         return view('exports.vendor', $data);
     }

     public function registerEvents(): array
     {
         return [
             AfterSheet::class => function(AfterSheet $event) {
                 $workSheet = $event->sheet->getDelegate();
                 $workSheet->freezePane('A3'); // freezing here
             },
         ];
        }
    }
