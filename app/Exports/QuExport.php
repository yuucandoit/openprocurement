<?php

namespace App\Exports;

use App\Models\CategoryQuotation;
use App\Models\Q_Quotation;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class QuExport implements ShouldAutoSize, FromView, WithCustomStartCell, WithColumnWidths, WithDrawings
{
    // RETURN VIEWS

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['q_quotation'] = Q_Quotation::where('category_id', $this->id)->get();
        $data['category_q'] = CategoryQuotation::where('id', $this->id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        return view('exports.quotation', $data);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 3,
            'B' => 15,
            'C' => 40,
            'D' => 10,
            'E' => 10,
            'F' => 16,
            'G' => 16
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('assets/images/intek.png'));
        $drawing->setHeight(110);
        $drawing->setCoordinates('B2');

        return $drawing;
    }

    public function startCell(): string
    {
        return 'E3';
    }

    // FORMAT

    // public function columnFormats(): array
    // {
    //     return [
    //         // 'F12' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //         // 'F13' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    //         'F14' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    //         // 'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }
}



