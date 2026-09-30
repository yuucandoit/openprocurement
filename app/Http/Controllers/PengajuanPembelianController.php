<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanItemExport;
use App\Exports\POItemExport;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_pd = CategoryPengajuanPembelian::find($id);
        $pd = PengajuanPembelian::paginate(10, ['*'],'old');
        $new = ItemPO::paginate(10, ['*'],'new');
        return view('pengajuanPembelian.index')
            ->with('pd', $pd)
            ->with('new', $new);
            // ->with('data_pd', $data_pd);
    }

    public function SearchItemPPB(Request $request)
   {
    $cari = $request->carippb;
    $pd = PengajuanPembelian::Where('id','like',"%".$cari."%")
    ->orWhere('item','like',"%".$cari."%")
    ->orWhere('kategori','like',"%".$cari."%")
    ->orWhere('qty','like',"%".$cari."%")
    ->orWhere('unit_price','like',"%".$cari."%")
    ->orWhere('total','like',"%".$cari."%")
    ->paginate(10, ['*'],'old');
    $new = ItemPO::paginate(10,['*'],'new');

    return view('pengajuanPembelian.index')
    ->with('pd',$pd)
    ->with('new',$new);
   }

   public function SearchItemPO(Request $request)
   {
    $cari = $request->caripo;
    $new = ItemPO::Where('id','like',"%".$cari."%")
    ->orWhere('item','like',"%".$cari."%")
    ->orWhere('qty','like',"%".$cari."%")
    ->orWhere('kategori','like',"%".$cari."%")
    ->orWhere('unit_price','like',"%".$cari."%")
    ->orWhere('total','like',"%".$cari."%")
    ->orWhere('discount','like',"%".$cari."%")
    ->orWhere('dpp','like',"%".$cari."%")
    ->orWhere('ongkir','like',"%".$cari."%")
    ->orWhere('admin_fee','like',"%".$cari."%")
    ->orWhere('matauang','like',"%".$cari."%")
    ->orWhere('ppn','like',"%".$cari."%")
    ->orWhere('grand_total','like',"%".$cari."%")
    ->paginate(10, ['*'],'new');
    $pd = PengajuanPembelian::paginate(10, ['*'],'old');

    return view('pengajuanPembelian.index')
    ->with('pd',$pd)
    ->with('new',$new);
   }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $dv = $request->except(['_token']);
        PengajuanPembelian::insert([
            "pp_id" => $id,
            "matauang" => $request->matauang,
            "item" => $request->item,
            "qty" => $request->qty,
            "unit_price" => $request->unit_price,
            "total" => $request->qty * $request->unit_price
        ]);
        return redirect("pengajuan-pembelian/" . $id)->with('success', 'Task Created Successfully!');
    }

    public function export()
    {
        return (new PengajuanItemExport())->download('pengajuan_item.xlsx');
        // return Excel::download(new PengajuanItemExport, 'pengajuan_pembelian.xlsx');
    }

    public function exportnew()
    {
        return (new POItemExport())->download('po_item.xlsx');
        // return Excel::download(new PengajuanItemExport, 'pengajuan_pembelian.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $pp_id)
    {
        $pp = PengajuanPembelian::find($pp_id);
        $category_pp = CategoryPengajuanPembelian::where('id', $id)->first();
        return view('pengajuanPembelian.show')
        ->with('pp', $pp)
        ->with('category_pp' , $category_pp);
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
        $item = PengajuanPembelian::find($id);
        PengajuanPembelian::where('id', $id)->update([
            "matauang" => $request->matauang,
            "item" => $request->item,
            "qty" => $request->qty,
            "unit_price" => $request->unit_price,
            "total" => $request->qty * $request->unit_price
        ]);
        return redirect("pengajuan-pembelian/" . $item->pp_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = PengajuanPembelian::find($id);
        $delete->delete();
        return redirect('pengajuan-pembelian/' . $delete->pd_id)->with('success', 'Task Deleted Successfully!');
    }
}
