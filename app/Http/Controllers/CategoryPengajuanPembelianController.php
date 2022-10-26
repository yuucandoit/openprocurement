<?php

namespace App\Http\Controllers;

use App\Exports\PPBExport;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Delivery;
use App\Models\Department;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use App\Models\User;
use App\Models\WhoSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CategoryPengajuanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 2) {
            $user = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $dataws = WhoSubmitted::all();
            $datadepartment = Department::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->with('referensi')->get();
            return view('pengajuanPembelian.menu.index')
                ->with('user', $user)
                ->with('datapt', $datapt)
                ->with('dataop', $dataop)
                ->with('dataec', $dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $user = User::where('id', Auth::user()->id)->get();
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $dataws = WhoSubmitted::all();
            $datadepartment = Department::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id', [3, 6, 7, 8, 9])->get();
            $datadv = CategoryPengajuanPembelian::all();
            return view('pengajuanPembelian.menu.index')
                ->with('user', $user)
                ->with('datapt', $datapt)
                ->with('dataop', $dataop)
                ->with('dataec', $dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment);
        }
    }

    public function detail($id)
    {
        /*$data_vendor*/
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $atasan             = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $delivery           = Delivery::where('ppb_id',$id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $purpose            = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        return view('pengajuanPembelian.menu.detail')
            ->with('atasan', $atasan)
            ->with('pengajuan', $pengajuan)
            ->with('delivery',$delivery)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('purpose', $purpose)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment);
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 6 ||$check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            return view('pengajuanpembelian')
            ->with('datappb', $datappb);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atasan             = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $purpose            = ReferensiNamaProject::all();
        return view('pengajuanPembelian.menu.create')
            ->with('atasan', $atasan)
            ->with('purpose', $purpose)
            ->with('dataws', $dataws)
            ->with('datadepartment', $datadepartment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
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
            $project = ReferensiNamaProject::create([
                'nama' => $request->nama,
            ]);
            $pengajuan = CategoryPengajuanPembelian::create([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'category_purpose'=>$request->category_purpose,
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
            $pengajuan = CategoryPengajuanPembelian::create([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'category_purpose'=>$request->category_purpose,
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
                    'pp_id'             => $pengajuan->id,
                    'item'              => $data['item'][$item],
                    'qty'               => $data['qty'][$item],
                    'kategori'          => $data['kategori'][$item],
                );
                // $unit_price = str_replace(".", "", $item['unit_price']);
                PengajuanPembelian::create($data2);
            }
        }



        return redirect('menu-pengajuan-pembelian/')->with('success', 'Task Created Successfully!');
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
    public function edit(Request $request,$id)
    {
        $atasan = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $purpose = ReferensiNamaProject::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        //dd($item);
        return view('pengajuanPembelian.menu.edit')
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
                'category_purpose'=>$request->category_purpose,
                'purpose' => $project->id,
                'department' => $request->department,
                'desc' => $request->desc,
                'atasan' => $request->atasan,
                'matauang' => $request->matauang,
                // 'proposed_supplier' => $request->proposed_supplier,
                'send_to' => $request->send_to,
            ]);
        } else {
            $pengajuan = CategoryPengajuanPembelian::where("id", $id)->update([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'ws' => $request->ws,
                'category_purpose'=>$request->category_purpose,
                'purpose' => $request->purpose,
                'department' => $request->department,
                'desc' => $request->desc,
                'atasan' => $request->atasan,
                'matauang' => $request->matauang,
                // 'proposed_supplier' => $request->proposed_supplier,
                'send_to' => $request->send_to,
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
        return redirect("menu-pengajuan-pembelian/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data1 = PengajuanPembelian::where('pp_id', $id);
        $data1->delete();
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/menu-pengajuan-pembelian')->with('success', 'Task Deleted Successfully!');
    }

    public function export($id)
    {
        return Excel::download(new PPBExport($id), 'pengajuan_pembelian.xlsx');
    }

    // public function accept_atasan($id)
    // {
    //     $data = CategoryPengajuanPembelian::find($id);
    //     // dd($data);
    //     $data->status = 'Accepted';
    //     $data->save();
    //     return redirect()->back();
    // }

    // public function accept($id)
    // {
    //     $data = CategoryPengajuanPembelian::find($id);
    //     // dd($data);
    //     $data->status = 'Accepted';
    //     $data->save();
    //     return redirect()->back();
    // }

    // public function reject($id)
    // {
    //     $data = CategoryPengajuanPembelian::find($id);
    //     $data->status = 'Rejected';
    //     $data->save();
    //     return redirect()->back();
    // }
}
