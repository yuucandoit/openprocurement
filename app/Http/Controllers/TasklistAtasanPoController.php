<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPT;
use App\Models\Department;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use App\Models\TaskListAtasanPO;
use App\Models\User;
use App\Models\WhoSubmitted;
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
            // dd($data_atasan);
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
        $atasan = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $purpose = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department    ::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        return view('taskList_atasan_po.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment)
            ->with('item', $item)
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
        // dd($data);
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

        // $tes = CategoryPengajuanPembelian::where("id", $id)->update([
        //     "date_ps" => $request->date_ps,
        //     "ws" => $request->ws,
        //     "purpose" => $request->purpose,
        //     "send_to" => $request->send_to,
        //     "dateline" => $request->dateline,
        //     "department" => $request->department,
        // ]);

        $request->validate([
            'addMoreInputFields.*.item' => 'required',
            'addMoreInputFields.*.qty' => 'required',
            'addMoreInputFields.*.unit_price' => 'required'
        ]);


        foreach ($request->addMoreInputFields as $item) {
            $unit_price = str_replace(".", "", explode('Rp. ', $item['unit_price'])[1]);
            PengajuanPembelian::where("id", $id)->update([
                'item'          => $item['item'],
                'qty'           => $item['qty'],
                'kategori'      => $item['kategori'],
                'unit_price'    => (int)$unit_price,
                'total'         => $item['total'],
            ]);
        }
        return redirect("menu-taskList-atasan-po/");
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
        $data->image = 'ttdcontoh.png';
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
