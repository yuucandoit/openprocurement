<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\PengajuanPembelian;
use App\Models\PurchaseOrder;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('purchaseOrder.menu.index')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::all();
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('purchaseOrder.menu.history')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $datapo             = CategoryPO::where('ppb_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        return view('purchaseOrder.menu.detail')
        ->with('pengajuan', $pengajuan)
        ->with('dpp', $dpp)
        ->with('datapo', $datapo)
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
    public function create($id)
    {
        $pt                 = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $datapo             = CategoryPO::where('ppb_id', $id)->get();
        $atasan             = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $terms              = TermsAndConditions::all();
        $dv                 = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        return view('purchaseOrder.menu.create')
        ->with('pt', $pt)
        ->with('op',$op)
        ->with('ec',$ec)
        ->with('datapo' , $datapo)
        ->with('dv' , $dv)
        ->with('atasan' , $atasan)
        ->with('terms' , $terms)
        ->with('pengajuan', $pengajuan)
        ->with('dpp', $dpp)
        ->with('ppn', $ppn)
        ->with('total', $total)
        ->with('total_tnpa_ppn', $total_tnpa_ppn);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $pt = CategoryPT::find($id);
        $pp = CategoryPP::find($id);
        $ec = CategoryEcommerce::find($id);

        if($request->term_conditions == "custom"){
            // dd($data);
            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);

            // if($request->vendor ==)
            $tes = CategoryPO::create([
                "ppb_id" => $data->id,
                "vendorable_type" => $request->vendorable_type,
                "vendorable_id" => $request->vendorable_id,
                "term_conditions" => $term->id,
                "atasan_po" => $request->atasan_po,
                "address" => $request->address,
                "no_telp" => $request->no_telp,
                "no_npwp" => $request->no_npwp,
                "quotation" => $request->quotation,
            ]);

        } else {
            $tes = CategoryPO::create([
                "ppb_id" => $data->id,
                "vendorable_type" => $request->vendorable_type,
                "vendorable_id" => $request->vendorable_id,
                "term_conditions" => $request->term_conditions,
                "atasan_po" => $request->atasan_po,
                "address" => $request->address,
                "no_telp" => $request->no_telp,
                "no_npwp" => $request->no_npwp,
                "quotation" => $request->quotation,
            ]);
        }


// dd($data_all

    return redirect("menu-purchase-order/");
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
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        return view('purchaseOrder.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('purpose', $purpose)
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
        $data = CategoryPengajuanPembelian::find($id);

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
            PengajuanPembelian::where("id", $id)->update([
                'item'          => $item['item'],
                'qty'           => $item['qty'],
                'kategori'      => $item['kategori'],
                'unit_price'    => $item['unit_price'],
                'total'         => $item['qty'] * $item['unit_price'],
            ]);
        }
        return redirect("menu-purchase-order/");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/menu-purchase-order')->with('success', 'Task Deleted Successfully!');
    }

    public function ajukan_keatasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        // dd($data);
        $data->status = 'Waiting For PO Approval';
        $data->save();
        return redirect('menu-purchase-order');
    }

    public function Reject($id)
    {
        $data = CategoryPO::find($id);
        $data->status = 'Rejected By Purchasing';
        $data->save();
        return redirect('menu-purchase-order');
    }
}
