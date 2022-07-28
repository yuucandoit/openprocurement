<?php

namespace App\Http\Controllers;

use App\Exports\PdExport;
use App\Models\CategoryPD;
use App\Models\PengajuanDana;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PengajuanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {
        return view('pengajuanDana.menu');
    }

    public function index($id)
    {

        $data_pd = CategoryPD::find($id);
        $pd = PengajuanDana::where('pd_id', $id)->get();
        return view('pengajuanDana.index')
            ->with('pd', $pd)
            ->with('data_pd', $data_pd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data_pd = CategoryPD::find($id);
        return view('pengajuanDana.create')
            ->with('data_pd', $data_pd);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $pd = $request->except(['_token']);
        PengajuanDana::insert([
            "pd_id" => $id,
            "item" => $request->item,
            "qty" => $request->qty,
            "harga" => $request->harga,
            "total" => $request->qty * $request->harga
        ]);
        return redirect("pengajuan-dana/" . $id)->with('success', 'Task Created Successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $pd_id)
    {
        $pd = PengajuanDana::find($pd_id);
        $category_pd = CategoryPD::where('id', $id)->first();
        return view('pengajuanDana.show')
            ->with('pd', $pd)
            ->with('category_pd', $category_pd);
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
        $item = PengajuanDana::find($id);
        // dd($item);
        PengajuanDana::where('id', $id)->update([
            "item" => $request->item,
            "qty" => $request->qty,
            "harga" => $request->harga
        ]);
        return redirect("pengajuan-dana/" . $item->pd_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = PengajuanDana::find($id);
        $delete->delete();
        return redirect('pengajuan-dana/' . $delete->pd_id)->with('success', 'Task Deleted Successfully!');
    }


    public function export($id)
    {
        return Excel::download(new PdExport($id), 'pengajuan.xlsx');
    }
}
