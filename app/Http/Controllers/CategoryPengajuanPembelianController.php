<?php

namespace App\Http\Controllers;

use App\Exports\PPBExport;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\PengajuanPembelian;
use App\Models\ReferensiNamaProject;
use App\Models\Role;
use App\Models\User;
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
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id',[6,7,8,9])->get();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->with('referensi')->get();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('dataop',$dataop)
                ->with('dataec',$dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv);
        } else if ($check->role_id == 1 || $check->role_id == 3) {
            $datapt = CategoryPT::all();
            $dataop = CategoryPP::all();
            $dataec = CategoryEcommerce::all();
            $purpose = ReferensiNamaProject::all();
            $atasan = User::whereIn('id',[6,7,8,9])->get();
            $datadv = CategoryPengajuanPembelian::where('user_id', Auth::user()->id)->with('referensi')->get();
            return view('pengajuanPembelian.menu.index')
                ->with('datapt',$datapt)
                ->with('dataop',$dataop)
                ->with('dataec',$dataec)
                ->with('atasan', $atasan)
                ->with('purpose', $purpose)
                ->with('datadv', $datadv);
        }
    }

    public function detail($id)
    {
        /*$data_vendor*/  $data_pengajuan = CategoryPengajuanPembelian::find($id)->with('referensi')->first();
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $atasan = User::whereIn('id',[6,7,8,9])->get();
        $purpose = ReferensiNamaProject::all();
        return view('pengajuanPembelian.menu.detail')
            ->with('atasan', $atasan)
            ->with('pengajuan', $pengajuan)
            ->with('purpose', $purpose)
            ->with('data_pengajuan', $data_pengajuan);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $atasan = User::whereIn('id',[6,7,8,9])->get();
        $purpose = ReferensiNamaProject::all();
        return view('pengajuanPembelian.menu.create')
            ->with('atasan', $atasan)
            ->with('purpose', $purpose);
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

        if($request->purpose == "custom"){
            $project = ReferensiNamaProject::create([
                'nama' => $request->nama,
            ]);
           $pengajuan = CategoryPengajuanPembelian::create([
                'user_id' =>  Auth::user()->id,
                'date_ps' => $request->date_ps,
                'dateline' => $request->dateline,
                'ws' => $request->ws,
                'purpose' => $project->id,
                'department' => $request->department,
                'desc' => $request->desc,
                'atasan' => $request->atasan,
                'matauang' => $request->matauang,
                'proposed_supplier' => $request->proposed_supplier,
                'send_to' => $request->send_to,
                'ppn' => $request->ppn,
            ]);
       }else{
        $pengajuan = CategoryPengajuanPembelian::create([
            'user_id' =>  Auth::user()->id,
            'date_ps' => $request->date_ps,
            'dateline' => $request->dateline,
            'ws' => $request->ws,
            'purpose' => $request->purpose,
            'department' => $request->department,
            'desc' => $request->desc,
            'atasan' => $request->atasan,
            'matauang' => $request->matauang,
            'proposed_supplier' => $request->proposed_supplier,
            'send_to' => $request->send_to,
            'ppn' => $request->ppn,
        ]);
       }


        $request->validate([
            'addMoreInputFields.*.item' => 'required',
            'addMoreInputFields.*.qty' => 'required',
            'addMoreInputFields.*.unit_price' => 'required'
        ]);

        foreach($request->addMoreInputFields as $item ) {
            $unit_price = $item['unit_price'];
            PengajuanPembelian::create([
            'pp_id'             => $pengajuan->id,
            'item'              => $item['item'],
            'qty'               => $item['qty'],
            'kategori'          => $item['kategori'],
            'unit_price'        => $unit_price,
            'total'             => $item['total'],
        ]);
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
    public function edit(Request $request ,$id)
    {
        $datapt = CategoryPT::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $purpose = ReferensiNamaProject::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        return view('pengajuanPembelian.menu.edit')
        ->with('datapt', $datapt)
        ->with('purpose', $purpose)
        ->with('item', $item)
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

        dd($data);
        $tes = CategoryPengajuanPembelian::where("id", $id)->update([
            "date_ps" => $request->date_ps,
            "ws" => $request->ws,
            "purpose" => $request->purpose,
            "send_to" => $request->send_to,
            "dateline" => $request->dateline,
            "department" => $request->department,
            "proposed_supplier" => $request->proposed_supplier,
        ]);

        $request->validate([
            'addMoreInputFields.*.item' => 'required',
            'addMoreInputFields.*.qty' => 'required',
            'addMoreInputFields.*.unit_price' => 'required'
        ]);


        foreach($request->addMoreInputFields as $item ) {
             PengajuanPembelian::where("id", $id)->update([
            'item'          => $item['item'],
            'qty'           => $item['qty'],
            'kategori'      => $item['kategori'],
            'unit_price'    => $item['unit_price'],
            'total'         => $item['qty'] * $item['unit_price'],
        ]);
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

    public function accept_atasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function accept($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->status = 'Accepted';
        $data->save();
        return redirect()->back();
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected';
        $data->save();
        return redirect()->back();
    }

}
