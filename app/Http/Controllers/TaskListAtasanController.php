<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\TaskListAtasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListAtasanController extends Controller
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
            $datadv = TaskListAtasan::all();
            return view('taskList_atasan.menu.index')
            ->with('datappb', $datappb)
            ->with('datadv', $datadv);
        }
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 6 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $datadv = TaskListAtasan::all();
            return view('taskList_atasan.menu.history')
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
        return view('taskList_atasan.menu.detail')
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
        return view('taskList_atasan.menu.edit')
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
            "desc" => $request->desc,
            "purpose" => $request->purpose,
            "priceperunit" => $request->priceperunit,
            "send_to" => $request->send_to,
            "dateline" => $request->dateline,
            "proposed_supplier" => $request->proposed_supplier,
        ]);
        return redirect("menu-taskList-atasan/");
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
        // dd($data);
        if($data->dateline == '≤3Jam'){
            $data->dateline_time = ('03:00:00');
            $data->updated_at = Carbon::now();
            $data->approved_at = now();
            $data->status = 'Purchase Submission Approved' ;
        }elseif($data->dateline == '≤24Jam'){
            $data->dateline_time = ('24:00:00');
            $data->updated_at = Carbon::now();
            $data->approved_at = now();
            $data->status = 'Purchase Submission Approved';
        }elseif($data->dateline == '≤2Hari'){
            $data->dateline_time = ('48:00:00');
            $data->updated_at = Carbon::now();
            $data->approved_at = now();
            $data->status = 'Purchase Submission Approved';
        }
        $data->save();
        return redirect("menu-taskList-atasan/");
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Purchase Submission Rejected';
        $data->save();
        return redirect()->back();
    }
}
