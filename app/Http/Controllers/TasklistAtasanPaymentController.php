<?php

namespace App\Http\Controllers;

use App\Models\CategoryPD;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use App\Models\TasklistAtasanPayment;
use App\Models\User;
use App\Models\WhoSubmitted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasklistAtasanPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', Auth::user()->id)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function taskPySindu()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', 6)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function taskPyBayu()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', 7)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function taskPyVictor()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', 8)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function taskPyErwin()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', 9)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function taskPyTriyani()
    {
        $check = Auth::user();
        if ($check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('atasan_py', 24)->where('status','Invoicing Process');
            })->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');

            $datapo = CategoryPO::get();
            // $py   = Invoicing::orderBy('ppb_id', 'asc')->first();

            return view('taskList_atasan_payments.menu.index')
            // ->with('py',$py)
            ->with('datapo', $datapo)
            ->with('datappb', $datappb);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchTaskPYIn(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('status','Invoicing Process')->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(5);
     $datapo = CategoryPO::get();
     return view('taskList_atasan_payments.menu.index')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }

    public function SearchTaskPYOut(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datahstry = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);
     $datapo = CategoryPO::get();

     return view('taskList_atasan_payments.out')
     ->with('datahstry',$datahstry)
     ->with('datapo', $datapo);
    }

    public function history()
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('atasan_py', Auth::user()->id)->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $datapo = CategoryPO::get();
            return view('taskList_atasan_payments.menu.history')
            ->with('datappb', $datappb)
            ->with('datapo', $datapo);
        }else {
            return redirect()->route('dashboard');
        }
    }


    public function SearchHistoryTaskPY(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);
     $datapo = CategoryPO::get();

     return view('taskList_atasan_payments.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }

    public function SortHistoryPyBod(Request $request)
    {
     $sort = $request->sort;
    //  dd($cari);
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('taskList_atasan_payments.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function detail($id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $data_pengajuan     = CategoryPengajuanPembelian::find($id);
            $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
            $datapo             = CategoryPO::where('ppb_id', $id)->first();
            $items              = CategoryPO::where('ppb_id',$id)->get();
            $vendor             = CategoryPO::where('ppb_id',$id)->first();
            $comments           = Comment::where('ppb_id',$id)->get();
            $groupedItem        = ItemPO::groupBy('po_id')->get();
            $itempurchase       = ItemPO::groupBy('po_id')->first();
            $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $disc               = PengajuanPembelian::where('pp_id', $id)->first();
            return view('taskList_atasan_payments.menu.detail')
                ->with('pengajuan', $pengajuan)
                ->with('datapo',$datapo)
                ->with('groupedItem',$groupedItem)
                ->with('items',$items)
                ->with('itempurchase',$itempurchase)
                ->with('vendor',$vendor)
                ->with('comments', $comments)
                ->with('data_pengajuan', $data_pengajuan)
                ->with('dpp', $dpp)
                ->with('ppn', $ppn)
                ->with('total', $total)
                ->with('total_tnpa_ppn', $total_tnpa_ppn)
                ->with('disc', $disc);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function po_detail($id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $datapo             = CategoryPO::where('id', $id)->get();
            $datacpo            = CategoryPO::find($id);
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
            return view('taskList_atasan_payments.menu.po')
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
     * @param  \App\Models\TasklistAtasanPayment  $tasklistAtasanPayment
     * @return \Illuminate\Http\Response
     */
    public function show(TasklistAtasanPayment $tasklistAtasanPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TasklistAtasanPayment  $tasklistAtasanPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(TasklistAtasanPayment $tasklistAtasanPayment,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $atasan = User::whereIn('id', [3,6, 7, 8, 9])->get();
            $datapt = CategoryPT::all();
            $dv = CategoryPengajuanPembelian::find($id);
            $purpose = ReferensiNamaProject::all();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $item = PengajuanPembelian::where('pp_id', $id)->get();
            return view('taskList_atasan_payments.menu.edit')
                ->with('atasan', $atasan)
                ->with('datapt', $datapt)
                ->with('purpose', $purpose)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment)
                ->with('item', $item)
                ->with('dv', $dv);
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TasklistAtasanPayment  $tasklistAtasanPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
                PengajuanPembelian::where('pp_id',$id)->delete();
                $request->validate([
                    'purpose' => 'required',
                    'date_ps' => 'required',
                    'dateline'=> 'required',
                    'ws'      => 'required',
                    'department'=>'required',
                    'desc'  => 'required',
                    'atasan' => 'required',
                    'matauang'=>'required',
                    'send_to'=>'required',
                ],[
                    'purpose.required' => 'The Purpose field is required.',
                    'date_ps.required' => 'The Date field is required.',
                    'dateline.required' => 'The Date Line field is required.',
                    'ws.required' => 'The Who Submitted field is required.',
                    'department.required' => 'The Department field is required.',
                    'desc.required' => 'The Description field is required.',
                    'atasan.required' => 'The Super User field is required.',
                    'mata_uang.required' => 'The Currency field is required.',
                    'send_to.required' => 'The Send To field is required.',
                ]);

                $data2 = $request->all();
                //dd($data2);

                if ($request->purpose == "custom") {
                    $project = ReferensiNamaProject::where("id", $id)->update([
                        'nama' => $request->nama,
                    ]);
                    $pengajuan = CategoryPengajuanPembelian::where("id", $id)->update([
                        'user_id' =>  Auth::user()->id,
                        'date_ps' => $request->date_ps,
                        'dateline' => $request->dateline,
                        'ws' => $request->ws,
                        'purpose' => $project->id,
                        'department' => $request->department,
                        'desc' => $request->desc,
                        'atasan' => $request->atasan,
                        'matauang' => $request->matauang,
                        // 'proposed_supplier' => $request->proposed_supplier,
                        'send_to' => $request->send_to,
                        'ppn' => $request->ppn,
                    ]);
                } else {
                    $pengajuan = CategoryPengajuanPembelian::where("id", $id)->update([
                        'user_id' =>  Auth::user()->id,
                        'date_ps' => $request->date_ps,
                        'dateline' => $request->dateline,
                        'ws' => $request->ws,
                        'purpose' => $request->purpose,
                        'department' => $request->department,
                        'desc' => $request->desc,
                        'atasan' => $request->atasan,
                        'matauang' => $request->matauang,
                        // 'proposed_supplier' => $request->proposed_supplier,
                        'send_to' => $request->send_to,
                        'ppn' => $request->ppn,
                    ]);
                }



                if($request->item){
                    foreach ($data2['item'] as $item => $value) {
                        $unit_price = str_replace(".", "", $data2['unit_price'][$item]);
                        $data3 = array(
                            'pp_id'             => $id,
                            'item'              => $data2['item'][$item],
                            'qty'               => $data2['qty'][$item],
                            'kategori'          => $data2['kategori'][$item],
                            'unit_price'        => $unit_price,
                            'total'             => $data2['total'][$item],
                        );
                        // $unit_price = str_replace(".", "", $item['unit_price']);
                        PengajuanPembelian::create($data3);
                }
            }
                return redirect("menu-taskList-atasan-po/");
        }else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TasklistAtasanPayment  $tasklistAtasanPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TasklistAtasanPayment $tasklistAtasanPayment)
    {
        //
    }


    public function approve_payment_py(Request $request,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $cpo = CategoryPO::find($id);
            CategoryPengajuanPembelian::where('id', $cpo->ppb_id)->update([
                'note_bod_py' => $request->note_py,
            ]);
            $data = CategoryPengajuanPembelian::where('id', $cpo->ppb_id)->first();

            CategoryPO::where('id',$id)->update([
                'status' => 'Payment Approved'
            ]);

            $po = Invoicing::where('ppb_id', $cpo->ppb_id)->first();
            if($cpo->atasan_py == 3){
                $po->signature = 'superadmin.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }elseif($cpo->atasan_py == 6){
                $po->signature = 'sinduirawan.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }elseif($cpo->atasan_py == 7){
                $po->signature = 'bayu.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }elseif($cpo->atasan_py == 8){
                $po->signature = 'victor.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }elseif($cpo->atasan_py == 9){
                $po->signature = 'erwin.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }elseif($cpo->atasan_py == 24){
                $po->signature = 'Triyani.png';
                $po->approved_at = Carbon::now();
                $po->save();
            }

            if($cpo->ppb->status == 'Invoicing Process'){
                CategoryPengajuanPembelian::where('id',$cpo->ppb->id)->update([
                    'status' => 'Payment Approved',
                ]);
            }
            return redirect('menu-taskList-atasan-payment');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function accept_atasan_selected_pymnt(Request $request)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $ids = explode(',', $request->ids);
            // dd($ids);
            $data = CategoryPO::find($ids);
            // dd($po);

            foreach($data as $d){
            if($d->atasan_py == 3){
                Invoicing::whereIn('po_id',$ids)->update([
                'signature' => 'superadmin.png',
                'approved_at' => Carbon::now(),
                ]);
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
            }elseif($d->atasan_py == 6){
                Invoicing::whereIn('po_id',$ids)->update([
                    'signature' => 'sinduirawan.png',
                    'approved_at' => Carbon::now(),
                    ]);
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
            }elseif($d->atasan_py == 7){
                Invoicing::whereIn('po_id',$ids)->update([
                    'signature' => 'bayu.png',
                    'approved_at' => Carbon::now(),
                ]);
                $d->status = 'Payment Approved';
                $d->save();
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
            }elseif($d->atasan_py == 8){
                Invoicing::whereIn('po_id',$ids)->update([
                    'signature' => 'victor.png',
                    'approved_at' => Carbon::now(),
                ]);
                $d->status = 'Payment Approved';
                $d->save();
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
            }elseif($d->atasan_py == 9){
                Invoicing::whereIn('po_id',$ids)->update([
                    'signature' => 'erwin.png',
                    'approved_at' => Carbon::now(),
                ]);
                $d->status = 'Payment Approved';
                $d->save();
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
            }elseif($d->atasan_py == 24){
                Invoicing::whereIn('po_id',$ids)->update([
                    'signature' => 'Triyani.png',
                    'approved_at' => Carbon::now(),
                ]);
                $d->status = 'Payment Approved';
                $d->save();
                CategoryPO::whereIn('id',$ids)->update([
                    'status' => 'Payment Approved'
                ]);

                if($d->ppb->status == 'Invoicing Process'){
                    CategoryPengajuanPembelian::where('id',$d->ppb->id)->update([
                        'status' => 'Payment Approved',
                    ]);
                }
                }
            }

            return redirect('menu-taskList-atasan-payment');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function reject(Request $request,$id)
    {
        $check = Auth::user();
        if ($check->role_id == 6 || $check->role_id == 19 ||$check->role_id == 3) {
            $cpo = CategoryPO::find($id);
            $cpo->status = 'Payment Rejected by BOD';
            $cpo->note_bod_py = $request->note_py;
            $cpo->save();

            return redirect('menu-taskList-atasan-payment');
        }else{
            return redirect()->route('dashboard');
        }
    }

    // public function reject(Request $request,$id)
    // {
    //     $data = CategoryPengajuanPembelian::find($id);
    //     $data->status = 'Payment Rejected by BOD';
    //     $data->note_bod_py = $request->note_py;
    //     $data->save();
    //     CategoryPO::where('ppb_id',$id)->update([
    //         'status' => 'Payment Rejected by BOD'
    //     ]);
    //     return redirect('menu-taskList-atasan-payment');
    // }
}
