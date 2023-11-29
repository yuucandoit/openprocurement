<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\TermsAndConditions;
use App\Models\User;
use App\Models\WhoSubmitted;
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
            $datappb = CategoryPengajuanPembelian::whereHas('quot',function($i){
                $i->where('status','Cross Check PO');
            })->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datapo = CategoryPO::get();

            return view('purchaseOrder.menu.check-po.index')
                ->with('datappb',$datappb)
                // ->with('datappb2',$datappb2)
                ->with('datapo', $datapo);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function po_detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3||$check->role_id == 17) {

            $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
            $datapo             = CategoryPO::where('id', $id)->get();
            $datacpo            = CategoryPO::where('id', $id)->first();
            $dataws             = WhoSubmitted::all();
            $datadepartment     = Department::all();
            $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
            $disc               = PengajuanPembelian::where('pp_id',$id)->first();
            $comments           = Comment::where('ppb_id',$id)->get();

            //dd($datacpo);
            return view('purchaseOrder.menu.check-po.po')
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
        $datapo = CategoryPO::WhereHas('ppb', function($q) use($cariIn){
            $q->where('status','like',"%".$cariIn."%");
        })->
        paginate(10, ['*'],'in');

        return view('purchaseOrder.menu.check-po.index')
        ->with('datappb',$datappb)
        ->with('datapo',$datapo);
    }

    public function ajukan_keatasan($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 || $check->role_id == 17) {
            $data = CategoryPengajuanPembelian::find($id);
            if(empty($data->atasan_po)){
                return redirect()->back()->withErrors(["Approver Not Found"]);
            }else{
            $data->status = 'Waiting For PO Approval';
            $data->w_approval_po_timestamp = now();
            $data->save();
            CategoryPO::where('ppb_id', $id)->update([
                'status' => 'Waiting For PO Approval'
            ]);
            return redirect('send-purchase/'.$data->id);
            }
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function ajukan_keatasan_po($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 || $check->role_id == 17) {
            $data = CategoryPO::find($id);
            $data->status = 'Waiting For PO Approval';
            $data->save();
            $ppb = CategoryPengajuanPembelian::where('id',$data->ppb->id)->first();
            if($ppb->status == 'Cross Check PO'){
                CategoryPengajuanPembelian::where('id', $data->ppb->id)->update([
                    'status' => 'Waiting For PO Approval',
                    'w_approval_po_timestamp' => now(),
                ]);
                return redirect('send-purchase/'.$ppb->id);
            }

            return redirect()->route('check_po.index');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function reject_po(Request $request,$id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 || $check->role_id == 17) {
            $data = CategoryPO::find($id);

            $ppb = CategoryPengajuanPembelian::where('id',$data->ppb->id)->first();
            CategoryPengajuanPembelian::where('id', $data->ppb->id)->update([
                'status' => 'Purchase Proses',
            ]);

            $data->status = 'Reject PO';
            $data->notes = $request->notes;
            $data->save();


            return redirect()->route('check_po.index');
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function detail($id)
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 3 || $check->role_id == 17) {
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
                ->with('ppn', $ppn)
                ->with('vendor', $vendor)
                ->with('items', $items)
                ->with('total', $total)
                ->with('disc' , $disc)
                ->with('total_tnpa_ppn', $total_tnpa_ppn)
                ->with('data_pengajuan', $data_pengajuan)
                ->with('comments', $comments);
        }else {
            return redirect()->route('dashboard');
        }
    }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 17 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->orWhere('status','PO Approved')->orWhere('status','Invoicing Process')
            ->orWhere('status','Payment Approved')->orWhere( 'status','Unpaid')
            ->orWhere('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orWhere('status','Rejected by Purchasing')->orWhere('status','PO Rejected by BOD')
            ->orWhere('status','Payment Rejected By BOD')->orWhere('status','Rejected by Finance')->orderBy('updated_at','desc')->paginate(10);
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('purchaseOrder.menu.check-po.history')
                ->with('pt', $pt)
                ->with('op', $op)
                ->with('ec', $ec)
                ->with('datappb', $datappb)
                ->with('datapo', $datapo);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function SearchHistoryCheckPO(Request $request)
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
     ->paginate(10);
     $datapo          = CategoryPO::get();

     return view('purchaseOrder.menu.check-po.history')
     ->with('datappb',$datappb)
     ->with('datapo', $datapo);
    }
    public function SortHistoryCheckPO(Request $request)
    {
     $sort = $request->sort;
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('purchaseOrder.menu.check-po.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }
}
