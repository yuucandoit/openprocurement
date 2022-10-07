<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\TaskListAtasanPO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasklistAtasanPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 6 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $data_atasan = CategoryPO::whereIn('atasan_po',[3, 6, 7, 8, 9])->get();
            $datadv = TaskListAtasanPO::all();
            // dd($data_atasan);
            return view('taskList_atasan_po.menu.index')
            ->with('data_atasan', $data_atasan)
            ->with('datappb', $datappb)
            ->with('datadv', $datadv);
        }
    }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 6 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $datadv = TaskListAtasanPO::all();
            return view('taskList_atasan_po.menu.history')
            ->with('datappb', $datappb)
            ->with('datadv', $datadv);
        }
    }

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        return view('taskList_atasan_po.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
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
        //
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
    public function edit($id)
    {
        $dv = CategoryPengajuanPembelian::find($id);
        return view('taskList_atasan_po.menu.edit')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function accept_atasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'PO Approved';
        $data->image = 'tandatangancontoh.png';
        $data->save();
        return redirect('menu-taskList-atasan-po');
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected by Super user';
        $data->save();
        return redirect()->back();
    }
}
