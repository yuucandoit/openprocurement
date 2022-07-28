<?php

namespace App\Exports;

use App\Models\CategoryPO;
use App\Models\CategoryQuotation;
use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;

class PoExport implements ShouldAutoSize, FromView, WithCustomStartCell, WithColumnWidths, WithDrawings
{
    // RETURN VIEWS

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data['purchase_order'] = PurchaseOrder::where('po_id', $this->id)->get();
        $data['category_po'] = CategoryPO::where('id', $this->id)->first();
        $data['category_q'] = CategoryQuotation::where('id', $this->id)->first();
        $data['day'] = Carbon::now()->format('d');
        $data['year2'] = Carbon::now()->format('Y');
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');
        return view('exports.purchaseorder', $data);
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
}



