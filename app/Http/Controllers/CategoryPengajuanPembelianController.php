<?php

namespace App\Http\Controllers;

use App\Exports\PPBExport;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPT;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CategoryPengajuanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 2) {
            $datapt = CategoryPT::all();
            $datapo = CategoryPO::all();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->with('pt')->with('po')->get();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('datapo', $datapo)
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datapt = CategoryPT::all();
            $datapo = CategoryPO::all();
            $datadv = CategoryPengajuanPembelian::all();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('datapo', $datapo)
                ->with('datadv', $datadv);
        }
    }

    public function detail($id)
    {
        /*$data_vendor*/  $data_pengajuan = CategoryPengajuanPembelian::find($id);
        return view('pengajuanPembelian.menu.detail')
            ->with('data_pengajuan', $data_pengajuan);
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
    public function store(Request $request)
    {
        $dv = $request->except(['_token']);
        $dv['user_id'] = Auth::user()->id;
        CategoryPengajuanPembelian::insert($dv);
        return redirect('menu-pengajuan-pembelian/')->with('success', 'Task Created Successfully!');
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
    public function edit(Request $request ,$id)
    {
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        return view('pengajuanPembelian.menu.edit')
        ->with('datapt', $datapt)
        ->with('dv' , $dv);
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
        $data = CategoryPengajuanPembelian::find($id);

        // dd($data);
        $tes = CategoryPengajuanPembelian::where("id", $id)->update([
            "date_ps" => $request->date_ps,
            "ws" => $request->ws,
            "item" => $request->item,
            "qty" => $request->qty,
            "ref" => $request->ref,
            "desc" => $request->desc,
            "purpose" => $request->purpose,
            "priceperunit" => $request->priceperunit,
            "send_to" => $request->send_to,
            "date_send" => $request->date_send,
            "proposed_supplier" => $request->proposed_supplier,
        ]);
        return redirect("menu-pengajuan-pembelian/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/menu-pengajuan-pembelian')->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        return Excel::download(new PPBExport($id), 'pengajuan_pembelian.xlsx');
    }

    public function accept_atasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function accept($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }

}
