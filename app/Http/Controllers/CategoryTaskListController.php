<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryTL;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryTaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status', 'Purchase Request Approved')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Purchase Proses')->orWhere('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')->orWhere('status','Payment Approved')->orWhere('status','Unpaid')->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $purpose = ReferensiNamaProject::all();
            return view('taskList.menu.index')
            ->with('purpose', $purpose)
            ->with('datappb', $datappb)
            ->with('datappb2', $datappb2);
        }
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            return view('taskList.menu.history')
            ->with('datappb', $datappb);
        }
    }

    public function detail($id)
    {
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $purpose            = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        return view('taskList.menu.detail')
        ->with('purpose',$purpose)
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
        $delete = CategoryPengajuanPembelian::find($id);
        $delete->delete();
    }
    public function accept(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->note_purchase = $request->note_purchase;
        $data->updated_at = now();
        $data->status = 'Purchase Proses';
        $data->save();
        return redirect('menu-task-list');
    }

    public function reject(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected by Purchasing';
         $data->note_purchase = $request->note_purchase;
        $data->save();
        return redirect('menu-task-list');
    }
}
