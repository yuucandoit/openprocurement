<?php

namespace App\Exports;

use App\Models\CategoryPD;
use App\Models\PengajuanDana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class PdExport implements WithColumnFormatting, FromView, WithCustomStartCell, WithColumnWidths
{
    // RETURN VIEWS 

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['pengajuan_d'] = PengajuanDana::where('pd_id', $this->id)->get();
        $data['category_pd'] = CategoryPD::where('id', $this->id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        return view('exports.pengajuandana', $data);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 3,
            'C' => 3,
            'D' => 3,
            'F' => 3
        ];
    }

    public function startCell(): string
    {
        return 'E3';
    }

    // FORMAT

    public function columnFormats(): array
    {
        return [
            // 'F12' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'F13' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'F14' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}


