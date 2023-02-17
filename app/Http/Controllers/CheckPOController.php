<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 || $check->role_id == 17) {
            $datappb = CategoryPengajuanPembelian::orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datapo = CategoryPO::where('status','Cross Check PO')->paginate(10);
            return view('purchaseOrder.menu.check-po.index')
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchCheckPO(Request $request)
    {
     $cariIn = $request->cariIn;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')->
     orWhere('id','like',"%".$cariIn."%")
     ->orWhere('status','like',"%".$cariIn."%")
     ->orWhere('desc','like',"%".$cariIn."%")
     ->orWhereHas('itemppn', function($i) use($cariIn){
         $i->where('item','like',"%".$cariIn."%");
     })
     ->orWhereHas('whosubmit', function($q) use($cariIn){
          $q->where('name','like',"%".$cariIn."%");
     })
     ->paginate(10, ['*'],'in');


     return view('purchaseOrder.menu.check-po.index')
     ->with('datappb',$datappb);
    }

    public function ajukan_keatasan($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        if(empty($data->atasan_po)){
            return redirect()->back()->withErrors(["Approver Not Found"]);
        }else{
        $data->status = 'Waiting For PO Approval';
        $data->save();
        return redirect('send-purchase/'.$data->id);
        }
    }

    // public function ajukan_keatasan($id)
    // {

    //     $crs = CategoryPO::find($id);
    //     $crs->status = 'Waiting For PO Approval';
    //     $crs->save();

    //     $data2 = CategoryPengajuanPembelian::where('id',$crs->ppb_id)->first();
    //     // dd($data2);
    //     $datapo = CategoryPO::where('status','Cross Check PO')->where('ppb_id',$crs->ppb_id)->get();
    //     $datapo2 = CategoryPO::where('ppb_id',$crs->ppb_id)->get();
    //     $count = $datapo->count();
    //     $count2 = $datapo2->count();
    //     if($count == $count2) {
    //     $data = CategoryPengajuanPembelian::find($id);
    //     if(empty($data->atasan_po)){
    //         return redirect()->back()->withErrors(["Approver Not Found"]);
    //     }else{
    //     $data->status = 'Waiting For PO Approval';
    //     $data->save();
    //     }
    //         }else{

    //     }
    //     return redirect('send-purchase/'.$data2->id );
    // }

    public function detail($id)
    {
        $pt                 = CategoryPT::all();
        $op                 = CategoryPP::all();
        $ec                 = CategoryEcommerce::all();
        $terms              = TermsAndConditions::all();
        $atasan             = User::whereIn('id', [3, 6, 7, 8, 9])->get();
        $data_pengajuan     = CategoryPengajuanPembelian::find($id);
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
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

        //dd($datacpo);
        return view('purchaseOrder.menu.check-po.detail')
            ->with('pt', $pt)
            ->with('op', $op)
            ->with('ec', $ec)
            ->with('terms', $terms)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('atasan', $atasan)
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            // ->with('datapo', $datapo)
            // ->with('datacpo', $datacpo)
            ->with('ppn', $ppn)
            ->with('vendor', $vendor)
            ->with('items', $items)
            // ->with('item', $item)
            ->with('total', $total)
            ->with('disc' , $disc)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan)
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
        //
    }
}
