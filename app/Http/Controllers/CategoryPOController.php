<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Department;
use App\Models\PengajuanPembelian;
use App\Models\PurchaseOrder;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use App\Models\WhoSubmitted;
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
            $datappb            = CategoryPengajuanPembelian::all();
            $pt                 = CategoryPT::all();
            $op                 = CategoryPP::all();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $ec                 = CategoryEcommerce::all();
            $datapo             = CategoryPO::all();
            return view('purchaseOrder.menu.index')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('dataws', $dataws)
                ->with('datadepartment', $datadepartment)
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
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        return view('purchaseOrder.menu.detail')
        ->with('pengajuan', $pengajuan)
        ->with('dpp', $dpp)
        ->with('datapo', $datapo)
        ->with('dataws', $dataws)
        ->with('datadepartment', $datadepartment)
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
        //dd($pengajuan);
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
        $data2 = $request->all();
        $pt = CategoryPT::find($id);
        $pp = CategoryPP::find($id);
        $ec = CategoryEcommerce::find($id);
        //dd($data2);

        PengajuanPembelian::where('pp_id',$id)->delete();


        if($request->term_conditions == "custom"){

            $term = TermsAndConditions::create([
                "term_condition" => $request->term_condition,
            ]);

                $tes = CategoryPO::create([
                    "ppb_id" => $data->id,
                    "term_conditions" => $term->id,
                    "vendorable_type" => $request->vendorable_type,
                    "vendorable_type" => $request->vendorable_type,
                    "atasan_po" => $request->atasan_po,
                    "address" => $request->address,
                    "no_telp" => $request->no_telp,
                    "no_npwp" => $request->no_npwp,
                    "quotation" => $request->quotation,
                ]);

                //vendorable

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

                PengajuanPembelian::create($data3);
            }
        }
        } else {
                $tes = CategoryPO::create([
                    "ppb_id" => $data->id,
                    "term_conditions" => $request->term_conditions,
                    "vendorable_type" => $request->vendorable_type,
                    "vendorable_id" => $request->vendorable_id,
                    "atasan_po" => $request->atasan_po,
                    "address" => $request->address,
                    "no_telp" => $request->no_telp,
                    "no_npwp" => $request->no_npwp,
                    "quotation" => $request->quotation,
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
        //dd($request);

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
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $terms              = TermsAndConditions::all();
        $dv = CategoryPengajuanPembelian::find($id);
        $purpose = ReferensiNamaProject::all();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $item = PengajuanPembelian::where('pp_id', $id)->get();
        return view('purchaseOrder.menu.edit')
            ->with('atasan', $atasan)
            ->with('datapt', $datapt)
            ->with('op',$op)
            ->with('ec',$ec)
            ->with('terms',$terms)
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
        $data = CategoryPengajuanPembelian::find($id);
        $data2 = $request->all();
        PengajuanPembelian::where('pp_id',$id)->delete();


            if($request->term_conditions == "custom"){
                $term = TermsAndConditions::where('id',$id)->update([
                    "term_condition" => $request->term_condition,
                ]);


                // if($request->vendor ==)
                $tes = CategoryPO::where('ppb_id',$id)->update([
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

                $tes = CategoryPO::where('ppb_id',$id)->update([
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
           // dd($data2);

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
