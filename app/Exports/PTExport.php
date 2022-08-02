<?php

namespace App\Exports;

use App\Models\CategoryPT;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class PTExport implements ShouldAutoSize, FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['perusahaan'] = Perusahaan::where('pt_id', $this->id)->get();
        $data['dv'] = Perusahaan::where('id', $this->id)->first();
        $data['category_pt'] = CategoryPT::where('id', $this->id)->first();
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
