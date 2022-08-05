<?php

namespace App\Exports;

use App\Models\CategoryPP;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class PPExport implements ShouldAutoSize, FromView
{
    public function view(): View
    {
        $data['category_pp'] = CategoryPP::all();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        return view('exports.privateperson', $data);
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
