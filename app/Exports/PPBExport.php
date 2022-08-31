<?php

namespace App\Exports;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPT;
use App\Models\PengajuanPembelian;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PPBExport implements WithColumnFormatting, FromView, WithCustomStartCell, WithColumnWidths
{
    // RETURN VIEWS

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['category_pt'] = CategoryPT::all();
        $data['category_ppb'] = CategoryPengajuanPembelian::where('id', $this->id)->first();
        $data['ppb'] = PengajuanPembelian::where('pp_id', $this->id)->get();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        $data['day'] = Carbon::now()->format('d');
        return view('exports.pengajuanpembelian', $data);
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
