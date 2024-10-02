<?php

namespace App\Http\Controllers;

use App\Exports\DBPurchaseHistoryExport;
use App\Models\CategoryPO;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PoExport;
use App\Exports\PoPDFExport;
use App\Models\CategoryPengajuanPembelian;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel as ExcelExcel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {
        return view('purchaseOrder.menu');
    }

    public function index($id)
    {
        $data_company_po = CategoryPO::find($id);
        $po = PurchaseOrder::where('po_id', $id)->get();
        return view('purchaseOrder.index')
            ->with('po', $po)
            ->with('data_company_po', $data_company_po);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data_po = PurchaseOrder::all();
        $data_company_po = CategoryPO::find($id);
        // dd($data_company_po);
        return view('purchaseOrder.create')
            ->with('data_company_po', $data_company_po)
            ->with('data_po', $data_po);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $po = $request->except(['_token']);
        // dd($po);
        PurchaseOrder::insert([
            "po_id" => $id,
            "keterangan" => $request->keterangan,
            "qty" => $request->qty,
            "unit" => $request->unit,
            "unit_price" => $request->unit_price,
            "amount" => $request->qty * $request->unit_price
        ]);
        return redirect("purchase-order/" . $id)->with('success', 'Task Created Successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $po_id, $id)
    {
        $data = CategoryPO::find($po_id);

        $po = PurchaseOrder::where('id', $id)->first();
        // dd($po);
        return view('purchaseOrder.show')
            ->with('po', $po)
            ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = PurchaseOrder::find($id);

        // dd($data);
        $tes = PurchaseOrder::where("id", $id)->update([
            "keterangan" => $request->keterangan,
            "qty" => $request->qty,
            "unit" => $request->unit,
            "unit_price" => $request->unit_price,
            "amount" => $request->qty * $request->unit_price
        ]);
        return redirect("purchase-order/" . $data->po_id);
        // dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PurchaseOrder::find($id);
        $item->delete();
        return redirect("purchase-order/" . $item->po_id)->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        return Excel::download(new PoExport($id), 'purchase order.xlsx');
    }

    public function exportpdf($id)
    {
        // dd($id);
        $data['cpp'] = CategoryPengajuanPembelian::find($id);
        // $data['cpo'] = CategoryPO::where('ppb_id', $id)->get();
        // $data['item_po'] = CategoryPO::where('ppb_id',$id)->orderBy('vendorable_type','ASC')->get();
        $data['cpo'] = CategoryPO::where('ppb_id', $id)->first();
        // foreach($data['cpo'] as $po){
        // dd($po);
        // }
        $data['id'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['category_q'] = PengajuanPembelian::where('pp_id', $id)->get();
        $data['dpp'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total_tnp_ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['disc'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('purchaseOrder.export-pdf.purchase', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PurchaseOrder.pdf');

    }

    public function exportmultipdf($id)
    {
        // dd($id);
        // $data['cpp'] = CategoryPengajuanPembelian::find($id);
        $data['cpo'] = CategoryPO::where('ppb_id', $id)->groupBy('vendorable_type')->groupBy('vendorable_id')->get();
        $data['items'] = CategoryPO::where('ppb_id', $id)->get();
        $data['harga'] = ItemPO::groupBy('po_id')->get();
        $data['sig']   = CategoryPO::where('ppb_id', $id)->first();
        // $data['id'] = PengajuanPembelian::where('pp_id', $id)->first();
        // $data['category_q'] = PengajuanPembelian::where('pp_id', $id)->get();
        // $data['dpp'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        // $data['ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        // $data['total'] = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        // $data['total_tnp_ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        // $data['disc'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('purchaseOrder.export-pdf.purchase_multi', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PurchaseOrder.pdf');

    }

    public function exportpdf_poid($id)
    {
        $data['cpo'] = CategoryPO::find($id);
        $data['harga'] = ItemPO::where('po_id',$id)->groupBy('po_id')->get();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('purchaseOrder.export-pdf.purchase_id', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PurchaseOrder.pdf');

    }


    public function exportExcelSpesific(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();

        if ($check->role_id == 4 || $check->role_id == 3 || $check->role_id == 17) {
            $purposeId = $request->input('purpose_id', null);
            // $purposeType = $request->input('purpose_type', null);
            return Excel::download(new DBPurchaseHistoryExport($purposeId), 'Database Purchase History.xlsx');
        }else {
            return redirect()->route('dashboard');
        }
    }
}
