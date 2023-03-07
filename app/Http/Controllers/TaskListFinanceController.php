<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\Comment;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\TaskListFinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListFinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 ||$check->role_id == 5) {
            $datappb = CategoryPengajuanPembelian::where('status','Payment Approved')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Payment Approved')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->get();
            $datadv = TaskListFinance::all();
            $datapo = CategoryPO::get();
            return view('taskList_finance.menu.index')
            ->with('datappb2', $datappb2)
            ->with('datappb', $datappb)
            ->with('datadv', $datadv)
            ->with('datapo', $datapo);
        }
    }
    public function SearchTaskFinance(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);
     $datapo = CategoryPO::get();

     return view('taskList_finance.menu.index')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }

    public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 ||$check->role_id == 5) {
            $datappb = CategoryPengajuanPembelian::where('status','Unpaid')->
            orWhere('status','Paid')->
            orWhere('status','Delivery Process')->
            orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $datadv = TaskListFinance::all();
            $datapo = CategoryPO::get();
            return view('taskList_finance.menu.out')
            ->with('datappb', $datappb)
            ->with('datadv', $datadv)
            ->with('datapo', $datapo);
        }
    }

    public function SearchTaskFinanceOut(Request $request)
    {
     $cari = $request->cariout;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);
     $datapo = CategoryPO::get();

     return view('taskList_finance.menu.out')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 ||$check->role_id == 5) {
            $datappb = CategoryPengajuanPembelian::where('status','Unpaid')->
            orWhere('status','Paid')->
            orWhere('status','Delivery Process')->
            orWhere('status','Delivery Success')->paginate(10);
            $datadv = TaskListFinance::all();
            $datapo = CategoryPO::get();
            return view('taskList_finance.menu.history')
            ->with('datappb', $datappb)
            ->with('datadv', $datadv)
            ->with('datapo', $datapo);
        }
    }

    public function SearchHistoryTaskFinance(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhere('created_at','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);
     $datapo = CategoryPO::get();
     return view('taskList_finance.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }

    public function detail($id)
    {
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id',$id)->first();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $comments           = Comment::where('ppb_id',$id)->get();
        return view('taskList_finance.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('vendor', $vendor)
            ->with('items', $items)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('datacpo', $datacpo)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('disc', $disc)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('comments', $comments);
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
        //
    }

    public function approve(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Unpaid';
        $data->note_finance = $request->note_finance;
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Unpaid'
        ]);
        return redirect('menu-tasklist-finance');
    }

    public function reject(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected by Finance';
        $data->note_finance = $request->note_finance;
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Rejected by Finance'
        ]);
        return redirect('menu-tasklist-finance');
    }
}
