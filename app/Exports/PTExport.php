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


    public function view(): View
    {
        $data['category_pt'] = CategoryPT::all();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        return view('exports.perusahaan', $data);
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
