<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data_pd = CategoryPengajuanPembelian::find($id);
        $pd = PengajuanPembelian::where('pp_id', $id)->get();
        return view('pengajuanPembelian.index')
            ->with('pd', $pd)
            ->with('data_pd', $data_pd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // dd($item);
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
