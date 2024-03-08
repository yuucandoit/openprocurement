<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryTL;
use App\Models\ItemPO;
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
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::where('status','Purchase Request Approved')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Purchase Proses')->orWhere('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')->orWhere('status','Payment Approved')->orWhere('status','Unpaid')->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $purpose = ReferensiNamaProject::all();
            return view('taskList.menu.index')
            ->with('purpose', $purpose)
            ->with('datappb', $datappb)
            ->with('datappb2', $datappb2);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchtaskPOIn(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);
        $datappb = CategoryPengajuanPembelian::whereIn('status','Purchase Request Approved')->where('atasan_po', Auth::user()->id)->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')
        ->orWhere('id','like',"%".$cari."%")
        ->orWhere('status','like',"%".$cari."%")
        ->orWhere('desc','like',"%".$cari."%")
        ->orWhereHas('itemppn', function($i) use($cari){
            $i->where('item','like',"%".$cari."%");
        })
        ->orWhereHas('whosubmit', function($q) use($cari){
            $q->where('name','like',"%".$cari."%");
        })
        ->paginate(10);
        return view('taskList.menu.index')
        ->with('datappb',$datappb);
    }

    public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Purchase Proses')->orWhere('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')->orWhere('status','Payment Approved')->orWhere('status','Unpaid')->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('updated_at', 'desc')->paginate(10, ['*'],'out');
            return view('taskList.menu.out')
            ->with('datappb', $datappb);
        }
    }

    public function SearchtaskPOOut(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);
        $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
        ->orWhere('status','like',"%".$cari."%")
        ->orWhere('desc','like',"%".$cari."%")
        ->orWhereHas('itemppn', function($i) use($cari){
            $i->where('item','like',"%".$cari."%");
        })
        ->orWhereHas('whosubmit', function($q) use($cari){
            $q->where('name','like',"%".$cari."%");
        })
        ->orWhereHas('quot', function($i) use($cari){
            $i->whereIn('status','like',"%".$cari."%");
        })

        ->paginate(10);
        $datapo = CategoryPO::get();
        return view('taskList.menu.out')
        ->with('datappb',$datappb)
        ->with('datapo',$datapo);
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3 ||$check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::where('status','Purchase Proses')
            ->orWhere('status','Waiting For PO Approval')
            ->orWhere('status', 'PO Approved')
            ->orWhere('status', 'Invoicing Process')->orWhere('status', 'Payment Approved')
            ->orWhere('status', 'Unpaid')->orWhere('status', 'Paid')->orWhere('status', 'Delivery Process')
            ->orWhere('status','Delivery Success')->orWhere('status','PO Rejected by BOD')->orWhere('status','Rejected by Purchasing')->orWhere('status','Payment Rejected By BOD')
            ->orWhere('status','Rejected by Finance')->orderBy('approved_at','desc')->paginate(20);
            $datapo = CategoryPO::get();
            return view('taskList.menu.history')
            ->with('datappb', $datappb)
            ->with('datapo', $datapo);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchtaskPOHistory(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);
        $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
        ->orWhere('desc','like',"%".$cari."%")
        ->orWhereHas('itemppn', function($i) use($cari){
            $i->where('item','like',"%".$cari."%");
        })
        ->orWhereHas('whosubmit', function($q) use($cari){
            $q->where('name','like',"%".$cari."%");
        })
        ->orWhereHas('quot' , function($po) use($cari){
            $po->where('id','like',"%".$cari."%");
        })
        ->whereIn('status',['Purchase Proses','Waiting For PO Approval','PO Approved','Invoicing Process','Payment Approved','Unpaid','Paid','Delivery Process',
        'Delivery Success','PO Rejected by BOD','Rejected by Purchasing','Payment Rejected By BOD','Rejected by Finance'])
        ->paginate(10);
        $datapo = CategoryPO::get();
        return view('taskList.menu.history')
        ->with('datappb',$datappb)
        ->with('datapo',$datapo);
    }

    public function SortTaskPOHistory(Request $request)
    {
        $sort = $request->sort;
        //  dd($sort);
        $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->orWhereHas('quot', function($i) use($sort){
            $i->whereIn('status',$sort);
        })->orderBy('approved_at','desc')->paginate(10);
        $datapo = CategoryPO::get();
        return view('taskList.menu.history')
        ->with('datappb',$datappb)
        ->with('datapo',$datapo)
        ->with('sort',$sort);
    }

    public function detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            $data_pengajuan     = CategoryPengajuanPembelian::find($id);
            $purpose            = CategoryPengajuanPembelian::find($id);
            $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
            $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $vendor             = CategoryPO::where('ppb_id',$id)->first();
            $items              = CategoryPO::where('ppb_id',$id)->get();
            $groupedItem        = ItemPO::groupBy('po_id')->get();
            $itempurchase       = ItemPO::groupBy('po_id')->first();
            $disc               = PengajuanPembelian::where('pp_id',$id)->first();
            return view('taskList.menu.detail')
            ->with('purpose',$purpose)
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('items', $items)
            ->with('vendor', $vendor)
            ->with('groupedItem', $groupedItem)
            ->with('disc', $disc)
            ->with('itempurchase', $itempurchase);
        }else {
            return redirect()->route('dashboard');
        }
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
        // $delete = CategoryPengajuanPembelian::find($id);
        // $delete->delete();
    }
    public function accept(Request $request,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            $data = CategoryPengajuanPembelian::find($id);
            // dd($data);
            $data->note_purchase = $request->note_purchase;
            $data->updated_at = now();
            $data->status = 'Purchase Proses';
            $data->save();
            return redirect('menu-task-list');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function reject(Request $request,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            $data = CategoryPengajuanPembelian::find($id);
            //jika ada request image dia masuk kalo ngga skip
            if($request->hasFile('path_img')){
            $path_name        = $request->file('path_img');
            $name             = $path_name->getClientOriginalName();
            $path_name->move('upload_pengajuan_reject', $name);
            $data->path_img = $name;
            }
            if(!empty($data->quot)){
                foreach($data->quot as $po)
                {
                    $po->status = 'Rejected By Purchasing';
                    $po->notes = $request->note_purchase;
                    $po->save();
                }
            }
            $data->status = 'Rejected by Purchasing';
            $data->note_purchase = $request->note_purchase;
            $data->save();
            return redirect('menu-task-list');
        }else{
            return redirect()->route('dashboard');
        }
    }
}
