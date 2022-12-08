<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPT;
use App\Models\Department;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use App\Models\TaskListAtasan;
use App\Models\User;
use App\Models\WhoSubmitted;
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
            $datappb = CategoryPengajuanPembelian::orderBy('status', 'asc')->orderBy('dateline', 'asc')->get();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $datadv = TaskListAtasan::all();
            return view('taskList_atasan.menu.index')
            ->with('datappb', $datappb)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
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
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        return view('taskList_atasan.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
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
        $atasan = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $purpose = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        return view('taskList_atasan.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
            ->with('item', $item)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('dv', $dv);

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
        //dd($data);
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
            'atasan.required' => 'The Approved By field is required.',
            'mata_uang.required' => 'The Currency field is required.',
            'send_to.required' => 'The Send To field is required.',
        ]);

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


        if($request->item > 0){
            foreach ($data['item'] as $item => $value) {

                $data2 = array(
                    'pp_id'             => $id,
                    'item'              => $data['item'][$item],
                    'qty'               => $data['qty'][$item],
                    'kategori'          => $data['kategori'][$item],
                );
                // $unit_price = str_replace(".", "", $item['unit_price']);
                PengajuanPembelian::create($data2);
            }
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
    public function accept_atasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        // if($data->dateline == '≤3Jam'){
        //     $data->dateline_time = ('03:00:00');
        //     $data->updated_at = Carbon::now();
        //     $data->approved_at = now();
        //     $data->status = 'Purchase Submission Approved' ;
        // }
        if($data->dateline == '≤24Jam'){
            $data->dateline_time = ('25:00:00');
            $data->updated_at = Carbon::now();
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
            }

        }elseif($data->dateline == '≤48Jam'){
            $data->dateline_time = ('49:00:00');
            $data->updated_at = Carbon::now();
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
            }

        }elseif($data->dateline == '≤72Jam'){
            $data->dateline_time = ('73:00:00');
            $data->updated_at = Carbon::now();
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
            }

        }elseif($data->dateline == '≤96Jam'){
            $data->dateline_time = ('97:00:00');
            $data->updated_at = Carbon::now();
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
            }

        }elseif($data->dateline == '≤168Jam'){
            $data->dateline_time = ('169:00:00');
            $data->updated_at = Carbon::now();
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
            }

        }elseif($data->dateline == '≤336Jam'){
            $data->dateline_time = ('338:00:00');
            $data->updated_at = Carbon::now();
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
            }

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
