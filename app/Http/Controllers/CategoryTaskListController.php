<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryTL;
use App\Models\Comment;
use App\Models\ItemPO;
use App\Models\PartItem_Pre_pr;
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
    public function index(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        $arrayFilter = ['All','Tebet','Cikunir'];
        $filter = $request->filter ?? '';
        $cariIn = $request->cari ?? '';

        // Redirect jika role tidak sesuai
        if (!in_array($check->role_id, [3, 4, 17])) {
            return redirect()->route('dashboard');
        }
        $query = CategoryPengajuanPembelian::query()
        ->where('status','Purchase Request Approved')
        ->orderBy('dateline', 'asc')
        ->orderBy('approved_at', 'asc');

        if (in_array($check->role_id, [3, 17])) {
            // Tidak ada tambahan filter untuk role_id 3 dan 17
        } elseif ($check->role_id == 4) {
            if (!empty(Auth::user()->location) && Auth::user()->location == 'Cikunir') {
                $query->where('process_by', 'Cikunir');
            } else {
                $query->where(function ($q) {
                    $q->where('process_by', 'Tebet')
                      ->orWhereNull('process_by');
                });
            }
        }

         // Filter lokasi (filter)
        if (!empty($filter) && in_array($filter, ['Tebet', 'Cikunir'])) {
            if($filter == 'Tebet'){
                $query->where(function ($q) use($filter) {
                    $q->where('process_by', $filter)
                      ->orWhereNull('process_by');
                });
            }else{
                $query->where('process_by', $filter);
            }
        }

        // Pencarian (cariIn)
        if (!empty($cariIn)) {
            $query->where(function($q) use ($cariIn) {
                $q->where('id', 'like', "%$cariIn%")
                ->orWhere('type_pr', 'like', "%$cariIn%")
                ->orWhere('code_pengajuan', 'like', "%$cariIn%")
                ->orWhere('status', 'like', "%$cariIn%")
                ->orWhere('desc', 'like', "%$cariIn%")
                ->orWhereHas('itemppn', function($i) use ($cariIn) {
                    $i->where('item', 'like', "%$cariIn%");
                })
                ->orWhereHas('whosubmit', function($q) use ($cariIn) {
                    $q->where('name', 'like', "%$cariIn%");
                })
                ->orWhereHas('quot', function($posearch) use ($cariIn) {
                    $posearch->where('id', 'like', "%$cariIn%")
                            ->orWhere('code_po', 'like', "%$cariIn%");
                });
            });
        }

        // Paginasi data
        $datappb = $query->paginate(10, ['*'], 'in');

            return view('taskList.menu.index')
            ->with('datappb', $datappb)
            ->with('filter' , $filter)
            ->with('arrayFilter', $arrayFilter);
    }

    public function filterIndex(Request $request) 
    {
        $filter = $request->filter;
        $check = Role::where('model_id', Auth::user()->id)->first();
        $arrayFilter = ['All','Tebet','Cikunir'];

        $query = CategoryPengajuanPembelian::where('status','Purchase Request Approved')
            ->orderBy('dateline', 'asc')
            ->orderBy('approved_at', 'asc');

        if($filter == 'Cikunir'){
            $query->where('process_by','Cikunir');
        }elseif($filter == 'Tebet'){
            $query->where('process_by','Tebet');
        }
        $datappb = $query->paginate(10, ['*'],'in');

        if($check->role_id == 17){
            return view('taskList.menu.index')
                ->with('filter', $filter)
                ->with('arrayFilter', $arrayFilter)
                ->with('datappb', $datappb);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchtaskPOIn(Request $request)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        $cari = $request->cari;
        $userLocation = null;
        if($check->role_id != 3){
            $userLocation = Auth::user()->location;
        }
       
        $arrayFilter = ['All','Tebet','Cikunir'];
        //dd($cari);
        $datappb = CategoryPengajuanPembelian::where('status', 'Purchase Request Approved')
        ->orderBy('status', 'desc')
        ->orderBy('dateline', 'asc')
        ->orderBy('approved_at', 'asc')
        ->where(function($query) use ($cari) {
            $query->whereRaw('CAST(id AS CHAR) LIKE ?', ["%{$cari}%"])  // Ensure id is compared as a string
                ->orWhere('status', 'like', "%".$cari."%")
                ->orWhere('code_pengajuan', 'like', "%".$cari."%")
                ->orWhere('send_to', 'like', "%".$cari."%")
                ->orWhere('desc', 'like', "%".$cari."%")
                ->orWhereHas('itemppn', function($i) use ($cari) {
                    $i->where('item', 'like', "%".$cari."%");
                })
                ->orWhereHas('whosubmit', function($q) use ($cari) {
                    $q->where('name', 'like', "%".$cari."%");
                });
        })
        ->when(!empty($userLocation) && $userLocation == 'Cikunir', function ($query) use ($userLocation) {
            // Kondisi untuk lokasi Cikunir
            $query->where('process_by', $userLocation);
        }, function ($query) {
            // Kondisi untuk lokasi Tebet atau Null
            $query->where(function ($query) {
                $query->where('process_by', 'Tebet')
                      ->orWhereNull('process_by');
            });
        })
        
        ->paginate(10);
        return view('taskList.menu.index')
        ->with('datappb',$datappb)
        ->with('arrayFilter',$arrayFilter);
    }

    public function upComing()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::where('status','Awaiting Purchase Request Approval')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $purpose = ReferensiNamaProject::all();
            return view('taskList.menu.upcoming')
            ->with('purpose', $purpose)
            ->with('datappb', $datappb);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchtaskUpComming(Request $request)
    {
        $cari = $request->cari;
        //dd($cari);
        $datappb = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')
        ->where(function($query) use ($cari) {
            $query->where('id', 'like', "%".$cari."%")
                ->orWhere('status', 'like', "%".$cari."%")
                ->orWhere('desc', 'like', "%".$cari."%")
                ->orWhereHas('itemppn', function($i) use($cari){
                    $i->where('item', 'like', "%".$cari."%");
                })
                ->orWhereHas('whosubmit', function($q) use($cari){
                    $q->where('name', 'like', "%".$cari."%");
                });
        })
        ->orderBy('status', 'desc')
        ->orderBy('dateline', 'asc')
        ->orderBy('approved_at', 'asc')
        ->paginate(10);
        return view('taskList.menu.upcoming')
        ->with('datappb',$datappb);
    }

    public function upComingDetail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 ||$check->role_id == 3||$check->role_id == 17) {
            if($id){
                $datappb = CategoryPengajuanPembelian::find($id);
                $purpose = ReferensiNamaProject::all();
                return view('taskList.menu.detail_upcoming')
                ->with('purpose', $purpose)
                ->with('datappb', $datappb);
            }else {
                return redirect()->back()->with('message','ID Not Found ?!?');
            }

        }else {
            return redirect()->route('dashboard');
        }
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
            ->orWhere('status','Rejected by Finance')->orderBy('approved_at','desc')->paginate(10);
            $purpose = ReferensiNamaProject::all();
            return view('taskList.menu.history')
            ->with('datappb', $datappb)
            ->with('purpose', $purpose);
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
        $purpose = ReferensiNamaProject::all();
        return view('taskList.menu.history')
        ->with('datappb',$datappb)
        ->with('purpose',$purpose);
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
            $comments           = Comment::where('ppb_id',$id)->get();

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
            ->with('comments',$comments)
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
             //sum ulang product ke prepr kalau purposenya project
            if($data->purpose_type == 'App\Models\ReferensiNamaProject'){
                foreach ($data->itemppn as $item => $value) {
                    if(!empty($data->itemppn[$item]->id)){
                    $pengajuanItems = PengajuanPembelian::find($data->itemppn[$item]->id); // Kalau id nya ada maka get
                    }else {
                    $pengajuanItems = null; // kalau idnnya ga ada maka dbkin null
                    }

                    if($pengajuanItems){
                        $preprOldItems = PartItem_Pre_pr::where('id',$pengajuanItems->prepr_id)->first(); //kalau item oldnya ada maka get data old
                    } else {
                        $preprOldItems = null; //bikin null kalau item pr nya ga ada
                    }

                    // dd($preprOldItems->id);
                    if($preprOldItems){
                        //Update Data
                        $sumskuy = $preprOldItems->total + $pengajuanItems->qty; //Kalau minus dia ngurang jadi misal 10 + -(8); jadi 2
                        PartItem_Pre_pr::where('id', $preprOldItems->id)->update([
                            'total' => $sumskuy,
                        ]);
                    }
                }
            }


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
