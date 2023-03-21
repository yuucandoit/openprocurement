<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\PurchaseOrder;
use App\Models\ReferensiNamaProject;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use App\Models\WhoSubmitted;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InvoicingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3 || $check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::where('status','PO Approved')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Invoicing Process')
            ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
            ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->
            orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::get();
            return view('payment_request.menu.index')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datappb2',$datappb2)
                ->with('datapo', $datapo);
        }
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
        return view('payment_request.menu.po')
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

    public function SearchPaymentreq_in(Request $request)
   {
    $cariIn = $request->caripyIn;
    //dd($cari);
    $datappb = CategoryPengajuanPembelian::
    orWhere('id','like',"%".$cariIn."%")
    ->orWhere('status','like',"%".$cariIn."%")
    ->orWhere('desc','like',"%".$cariIn."%")
    ->orWhereHas('itemppn', function($i) use($cariIn){
        $i->where('item','like',"%".$cariIn."%");
   })
    ->orWhereHas('whosubmit', function($q) use($cariIn){
         $q->where('name','like',"%".$cariIn."%");
    })
    ->where('status','PO Approved')
    ->paginate(10,['*'],'in');


    return view('payment_request.menu.index')
    ->with('datappb',$datappb);
    // ->with('datappb2',$datappb2);
   }

   public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3 || $check->role_id == 17) {
            $datappb =  CategoryPengajuanPembelian::where('status','Invoicing Process')
            ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
            ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->
            orderBy('updated_at', 'desc')->paginate(10, ['*'],'out');
            $datappb2 = CategoryPengajuanPembelian::where('status','Invoicing Process')
            ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
            ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->
            orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $datapo = CategoryPO::get();
            return view('payment_request.menu.out')

                ->with('datappb',$datappb)
                ->with('datappb2',$datappb2)
                ->with('datapo', $datapo);
        }
    }

   public function SearchPaymentreq_out(Request $request)
   {
    $cariOut = $request->caripyOut;
    //dd($cari);
    $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
    ->orWhere('id','like',"%".$cariOut."%")
    ->orWhere('status','like',"%".$cariOut."%")
    ->orWhere('desc','like',"%".$cariOut."%")
    ->orWhereHas('itemppn', function($i) use($cariOut){
        $i->where('item','like',"%".$cariOut."%");
   })
    ->orWhereHas('whosubmit', function($q) use($cariOut){
         $q->where('name','like',"%".$cariOut."%");
    })
    ->paginate(10, ['*'],'out');

    return view('payment_request.menu.out')
    ->with('datappb',$datappb);
   }

    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Invoicing Process')
            ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
            ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orWhere('status','Payment Rejected By BOD')
            ->orWhere('status','Rejected by Finance')
            ->paginate(10);
            return view('payment_request.menu.history')
                ->with('datappb',$datappb);
        }
    }

    public function SortHistoryPaymentReq(Request $request)
    {
     $sort = $request->sort;
    //  dd($cari);
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('payment_request.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function SearchHistoryPaymentReq(Request $request)
   {
    $cari = $request->cari;
    //dd($cari);
    $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
    ->orWhere('id','like',"%".$cari."%")
    ->orWhere('status','like',"%".$cari."%")
    ->orWhere('desc','like',"%".$cari."%")
    ->orWhereHas('itemppn', function($i) use($cari){
        $i->where('item','like',"%".$cari."%");
   })
    ->orWhereHas('whosubmit', function($q) use($cari){
         $q->where('name','like',"%".$cari."%");
    })
    ->paginate(10, ['*'],'out');

    return view('payment_request.menu.history')
    ->with('datappb',$datappb);
   }

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datapo             = CategoryPO::where('ppb_id', $id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $comments           = Comment::where('ppb_id',$id)->get();
        return view('payment_request.menu.detail')
        ->with('pengajuan', $pengajuan)
        ->with('dpp', $dpp)
        ->with('datapo', $datapo)
        ->with('vendor', $vendor)
        ->with('items', $items)
        ->with('groupedItem', $groupedItem)
        ->with('itempurchase', $itempurchase)
        ->with('ppn', $ppn)
        ->with('total', $total)
        ->with('disc',$disc)
        ->with('total_tnpa_ppn', $total_tnpa_ppn)
        ->with('data_pengajuan', $data_pengajuan)
        ->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $atasan             = User::whereIn('id', [3,6, 7, 8, 9])->get();
        $atasan1            = User::whereIn('id', [3,6, 8, 9])->get();
        $atasan2            = User::whereIn('id', [3, 8, 9])->get();
        $atasan3            = User::whereIn('id', [3, 8])->get();
        $datapo             = CategoryPO::where('ppb_id',$id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        $dv                 = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();

        return view('payment_request.menu.create')
            ->with('data_pengajuan',$data_pengajuan)
            ->with('atasan', $atasan)
            ->with('atasan1', $atasan1)
            ->with('atasan2', $atasan2)
            ->with('atasan3', $atasan3)
            ->with('datapo', $datapo)
            ->with('items', $items)
            ->with('vendor', $vendor)
            ->with('dpp', $dpp)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
            ->with('pengajuan', $pengajuan)
            ->with('dv', $dv);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $all = $request->all();
        // dd($all);

        $data = CategoryPengajuanPembelian::find($id);
            $data->atasan_py = $request->atasan_py;
        $data->save();

        if ($request->hasFile('path_invoice')){

            $file = $request->file('path_invoice');
            $path_file = $file->getClientOriginalName();
            // dd($path_file);
            $file->move('upload_invoice',$path_file);

            CategoryPO::where('ppb_id',$id)->update([
                "path_invoice" => $path_file,
            ]);
        }

        $pyment = new Invoicing;
        $pyment->ppb_id = $data->id;
        $year = Carbon::parse($pyment->created_at)->format('y');
        $month = Carbon::parse($pyment->created_at)->format('m');
        $pyment->save();

        $py_id = str_pad($pyment->id,5,'0', STR_PAD_LEFT);
        $generatepd = strtoupper($py_id."/PD/SII/".$month."/".$year);
        Invoicing::where('id',$pyment->id)->update([
            'code_pd' => $generatepd,
        ]);

        return redirect("/payment_request");

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
        return view('payment_request.menu.edit')
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
        $data = CategoryPengajuanPembelian::find($id);
        $data->delete();
        return redirect('/payment_request')->with('success', 'Task Deleted Successfully!');
    }

    public function ajukan_dana($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        if(empty($data->atasan_po)){
            return redirect()->back()->withErrors(["Approver Not Found"]);
        }else{
        $data->status = 'Invoicing Process';
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Waiting For PO Approval'
        ]);

        return redirect('send-payment/'.$data->id);
        }
    }

    public function Reject($id)
    {
        $data = CategoryPO::find($id);
        $data->status = 'Rejected By Purchasing';
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Rejected By Purchasing'
        ]);
        return redirect('/payment_request');
    }
}
