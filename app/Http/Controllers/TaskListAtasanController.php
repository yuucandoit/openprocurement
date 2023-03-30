<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Inventory;
use App\Models\Office;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\RND;
use App\Models\Role;
use App\Models\TaskListAtasan;
use App\Models\User;
use App\Models\WhoSubmitted;
use App\Models\CategoryPO;
use App\Models\ItemPO;
use App\Models\Workshop;
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
            $datappb = CategoryPengajuanPembelian::where('atasan', Auth::user()->id)->where('status','Awaiting Purchase Request Approval')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('atasan', Auth::user()->id)->where('status', 'Purchase Request Approved')->
            orWhere('status','Purchase Proses')->
            orWhere('status','Waiting For PO Approval')->
            orWhere('status','PO Approved')->
            orWhere('status','Invoicing Process')->
           orWhere('status','Unpaid')->
           orWhere('status','Paid')->
           orWhere('status','Delivery Success')->orderBy('date_ps', 'desc')->orderBy('dateline', 'desc')->paginate(10, ['*'],'out');
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $datadv = TaskListAtasan::all();
            return view('taskList_atasan.menu.index')
            ->with('datappb', $datappb)
            ->with('datappb2', $datappb2)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('datadv', $datadv);
        }
    }

    public function SearchTaskRequestBodIn(Request $request)
    {
     $cariIn = $request->cariIn;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cariIn."%")
     ->orWhere('status','like',"%".$cariIn."%")
     ->orWhere('desc','like',"%".$cariIn."%")
     ->orWhereHas('whosubmit', function($q) use($cariIn){
          $q->where('name','like',"%".$cariIn."%");
     })
     ->paginate(10,['*'],'in');
     $cariOut = $request->cariOut;
     //dd($cari);
     $datappb2 = CategoryPengajuanPembelian::
     orWhere('id','like',"%".$cariOut."%")
     ->orWhere('status','like',"%".$cariOut."%")
     ->orWhere('desc','like',"%".$cariOut."%")
     ->orWhereHas('whosubmit', function($q) use($cariOut){
          $q->where('name','like',"%".$cariOut."%");
     })
     ->paginate(10,['*'],'out');

     return view('taskList_atasan.menu.index')
     ->with('datappb',$datappb)
     ->with('datappb2',$datappb2);
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 6 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('atasan', Auth::user()->id)->where('status', '!=' ,'Awaiting Purchase Request Approval')
            ->paginate(10);
            $datapo  = CategoryPO::get();

            // dd($datappb);
            $datadv = TaskListAtasan::all();
            return view('taskList_atasan.menu.history')
            ->with('datappb', $datappb)
            ->with('datapo', $datapo)
            ->with('datadv', $datadv);
        }
    }

    public function SearchHistoryRequestTask(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::
     orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);

     return view('taskList_atasan.menu.history')
     ->with('datappb',$datappb);
    }

    public function SortHistoryPrBod(Request $request)
    {
     $sort = $request->sort;
    //  dd($cari);
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('taskList_atasan.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $comments           = Comment::where('ppb_id',$id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        return view('taskList_atasan.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)

            ->with('comments', $comments)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('items', $items)
            ->with('vendor', $vendor)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase);
    }
    public function po_detail($id)
    {
        $datapo             = CategoryPO::where('id', $id)->get();
        $datacpo            = CategoryPO::where('id', $id)->first();
        $pengajuan          = PengajuanPembelian::where('pp_id', $datacpo->ppb_id)->get();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $datacpo->ppb_id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();

        //dd($datacpo);
        return view('taskList_atasan.menu.po')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('datapo', $datapo)
            ->with('dataws', $dataws)
            ->with('datacpo', $datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('disc', $disc)
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
        $atasan = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $purpose = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        $purpose            = ReferensiNamaProject::get();
        $purpose_office     = Office::all();
        $purpose_inventory  = Inventory::all();
        $purpose_workshop   = Workshop::all();
        $purpose_rnd        = RND::all();
        return view('taskList_atasan.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
            ->with('item', $item)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('dv', $dv)
            ->with('purpose', $purpose)
            ->with('purpose_office', $purpose_office)
            ->with('purpose_inventory', $purpose_inventory)
            ->with('purpose_workshop', $purpose_workshop)
            ->with('purpose_rnd', $purpose_rnd);

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
        $data = $request->all();
        // dd($data);
        // PengajuanPembelian::where('pp_id',$id)->delete();

        $request->validate([
            // 'purpose' => 'required',
            'date_ps' => 'required',
            'dateline'=> 'required',
            'ws'      => 'required',
            'department'=>'required',
            'desc'  => 'required',
            'atasan' => 'required',
            'matauang'=>'required',
            'send_to'=>'required',
        ],[
            // 'purpose.required' => 'The Purpose field is required.',
            'date_ps.required' => 'The Date field is required.',
            'dateline.required' => 'The Date Line field is required.',
            'ws.required' => 'The Who Submitted field is required.',
            'department.required' => 'The Department field is required.',
            'desc.required' => 'The Description field is required.',
            'atasan.required' => 'The Approved By field is required.',
            'mata_uang.required' => 'The Currency field is required.',
            'send_to.required' => 'The Send To field is required.',
        ]);

        $pengajuan = CategoryPengajuanPembelian::where('id',$id)->first();
            $pengajuan->update([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'ws' => $request->ws,
                'department' => $request->department,
                'desc' => $request->desc,
                'atasan' => $request->atasan,
                'matauang' => $request->matauang,
                'send_to' => $request->send_to,
            ]);
        if($request->category_purpose){
            if ($request->category_purpose == "project") {
                $purpose1 = ReferensiNamaProject::find($request->project);
                $purpose1->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose1->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "office") {
                $purpose2 = Office::find($request->office);
                $purpose2->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose2->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "workshop") {
                $purpose3 = Workshop::find($request->workshop);
                $purpose3->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose3->purposes()->save($pengajuan);
            } elseif ($request->category_purpose == "inventory") {
                $purpose4 = Inventory::find($request->inventory);
                $purpose4->purposes()->where('id',$id)->delete();
                $pengajuan = $purpose4->purposes()->save($pengajuan);
            }
        }


            foreach ($data['id'] as $item => $value) {
                $file = null;
                if($path = $request->file('path_file')[$item] ?? null) {
                    $file = $path->getClientOriginalName();
                    $path->move(public_path('upload_pengajuan'), $file);
                }
                $data2 = array(
                    'item'              => $data['item'][$item],
                    'qty'               => $data['qty'][$item],
                    'kategori'          => $data['kategori'][$item],
                    'path_file'         => $file,
                );
                PengajuanPembelian::updateOrCreate([
                    'id' => $value,
                ],$data2
            );
            }
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
    public function accept_atasan(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // if($data->dateline == '≤3Jam'){
        //     $data->dateline_time = ('03:00:00');
        //     $data->updated_at = Carbon::now();
        //     $data->approved_at = now();
        //     $data->status = 'Purchase Submission Approved' ;
        // }
        if($data->dateline == '≤24Jam'){
            $data->dateline_time = ('24:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }


        }elseif($data->dateline == '≤48Jam'){
            $data->dateline_time = ('49:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }

        }elseif($data->dateline == '≤72Jam'){
            $data->dateline_time = ('73:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }

        }elseif($data->dateline == '≤96Jam'){
            $data->dateline_time = ('97:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }

        }elseif($data->dateline == '≤168Jam'){
            $data->dateline_time = ('169:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }

        }elseif($data->dateline == '≤336Jam'){
            $data->dateline_time = ('338:00:00');
            $data->updated_at = Carbon::now();
            $data->note_bod_pr = $request->note_pr;
            $data->approved_at = now();
            $data->status = 'Purchase Request Approved';

            if($data->atasan == 3){
                $data->signature = 'superadmin.png';
            }elseif($data->atasan == 6){
                $data->signature = 'sinduirawan.png';
            }elseif($data->atasan == 7){
                $data->signature = 'bayu.png';
            }elseif($data->atasan == 8){
                $data->signature = 'victor.png';
            }elseif($data->atasan == 9){
                $data->signature = 'erwin.png';
            }elseif($data->atasan == 24){
                $data->signature = 'triyani.png';
            }

        }
        //dd($data);
        $data->save();
        return redirect("menu-taskList-atasan");
    }

    public function accept_atasan_selected(Request $request)
    {
        $ids = explode(',', $request->ids);
        $data = CategoryPengajuanPembelian::find($ids);
        // dd($data);
        // if($data->dateline == '≤3Jam'){
        //     $data->dateline_time = ('03:00:00');
        //     $data->updated_at = Carbon::now();
        //     $data->approved_at = now();
        //     $data->status = 'Purchase Submission Approved' ;
        // }
        // dd($data);
        foreach($data as $d) {
        if($d->dateline == '≤24Jam'){
            $d->dateline_time = ('24:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }elseif($d->dateline == '≤48Jam'){
            $d->dateline_time = ('49:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }elseif($d->dateline == '≤72Jam'){
            $d->dateline_time = ('73:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }elseif($d->dateline == '≤96Jam'){
            $d->dateline_time = ('97:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }elseif($d->dateline == '≤168Jam'){
            $d->dateline_time = ('169:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }elseif($d->dateline == '≤336Jam'){
            $d->dateline_time = ('338:00:00');
            $d->updated_at = Carbon::now();
            $d->approved_at = now();
            $d->status = 'Purchase Request Approved';

            if($d->atasan == 3){
                $d->signature = 'superadmin.png';
            }elseif($d->atasan == 6){
                $d->signature = 'sinduirawan.png';
            }elseif($d->atasan == 7){
                $d->signature = 'bayu.png';
            }elseif($d->atasan == 8){
                $d->signature = 'victor.png';
            }elseif($d->atasan == 9){
                $d->signature = 'erwin.png';
            }elseif($d->atasan == 24){
                $d->signature = 'triyani.png';
            }

        }
        $d->save();
    }
        return redirect("menu-taskList-atasan");
    }

    public function reject(Request $request,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Purchase Request Rejected By BOD';
        $data->note_bod_pr = $request->note_pr;
        $data->save();
        return redirect("menu-taskList-atasan");
    }
}
