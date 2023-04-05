<?php

namespace App\Http\Controllers;

use App\Exports\PembelianExport;
use App\Models\CategoryEcommerce;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\File;
use App\Models\Comment;
use App\Models\DeliveryTrack;
use App\Models\Department;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use App\Models\Role;
use App\Models\WhoSubmitted;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datappb = CategoryPengajuanPembelian::where('status','Paid')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
        $datappb2 = CategoryPengajuanPembelian::where('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
        $pt = CategoryPT::all();
        $op = CategoryPP::all();
        $ec = CategoryEcommerce::all();
        $datapo = CategoryPO::all();
        return view('delivery.menu.index')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datappb2',$datappb2)
                ->with('datapo', $datapo);
    }

    public function SearchDeliveryIn(Request $request)
    {
     $cari = $request->cariIn;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('status','Purchase Proses')->orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10, ['*'], 'in');

     $datappb2 = CategoryPengajuanPembelian::where('status','Delivery Success')
     ->orderBy('status', 'asc')->orderBy('dateline', 'asc')
     ->orderBy('approved_at','asc')->paginate(10, ['*'],'out');

     return view('delivery.menu.index')
     ->with('datappb',$datappb)
     ->with('datappb2',$datappb2);
    }
    public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Delivery Success')
            ->orderBy('status', 'asc')->orderBy('dateline', 'asc')
            ->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('delivery.menu.out')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchDeliveryOut(Request $request)
    {
     $cari = $request->cariOut;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::orderBy('status', 'desc')->orderBy('dateline', 'asc')->orderBy('approved_at', 'asc')
     ->orWhere('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10, ['*'], 'out');

     return view('delivery.menu.index')
     ->with('datappb',$datappb);
    }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 4 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Delivery Success')->paginate(10);
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('delivery.menu.history')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchHistoryDelivery(Request $request)
    {
     $cari = $request->cari;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10);

     return view('delivery.menu.history')
     ->with('datappb',$datappb);
    }

    public function SortHistoryDelivery(Request $request)
    {
     $sort = $request->sort;
    //  dd($cari);
     $datappb = CategoryPengajuanPembelian::whereIn('status',$sort)->paginate(10);
     $datapo = CategoryPO::get();
     return view('delivery.menu.history')
     ->with('datappb',$datappb)
     ->with('datapo',$datapo)
     ->with('sort',$sort);
    }

    public function create($id)
    {
        $dv                 = CategoryPengajuanPembelian::find($id);
        return view('delivery.menu.create')
        ->with('dv' , $dv);
    }
    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $delivery           = Delivery::where('ppb_id', $id)->get();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $status             = DeliveryTrack::where('ppb_id', $id)->get();
        return view('delivery.menu.detail')
        ->with('pengajuan', $pengajuan)
        ->with('dpp', $dpp)
        ->with('delivery',$delivery)
        ->with('vendor',$vendor)
        ->with('items', $items)
        ->with('groupedItem', $groupedItem)
        ->with('itempurchase', $itempurchase)
        ->with('dataws', $dataws)
        ->with('datadepartment', $datadepartment)
        ->with('ppn', $ppn)
        ->with('total', $total)
        ->with('total_tnpa_ppn', $total_tnpa_ppn)
        ->with('data_pengajuan', $data_pengajuan)
        ->with('disc', $disc)
        ->with('status', $status);
    }

    public function track($id)
    {
        return view('delivery.menu.tracking.index');
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
        $disc               = PengajuanPembelian::where('pp_id',$datacpo->ppb_id)->first();
        $comments           = Comment::where('ppb_id',$id)->get();

        //dd($datacpo);
        return view('delivery.menu.po')
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


    public function deliverystatus(Request $request, $id)
    {
        DeliveryTrack::create([
            'ppb_id' => $id,
            'status' => $request->status,
        ]);
        return redirect()->back();
    }


    public function store(Request $request, $id )
    {
        $data = CategoryPengajuanPembelian::find($id);
        $request->validate([
            'path_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);

           $pengajuan        = $data->id;
           $path_name        = $request->file('path_image');
           $name             = $path_name->getClientOriginalName();
           $path_name->move('images', $name);
           $receiver         = $request->receiver;

        //    $data = $request->all();
        //     dd($data);

           $save = new Delivery;
           $save->ppb_id     = $pengajuan;
           $save->path_image = $name;
           $save->receiver   = $receiver;
           $save->save();

           return redirect('/delivery')->with('status', 'Data Has been uploaded successfully ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery,$id)
    {
        $dv  = CategoryPengajuanPembelian::find($id);
        $delivery = Delivery::where('ppb_id',$id)->get();

        return view('delivery.menu.edit')
        ->with('delivery', $delivery)
        ->with('dv' , $dv);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery,$id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $request->validate([
            'path_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'receiver'   => 'required',
           ]);
           $pengajuan        = $data->id;
           $path_name        = $request->file('path_image');
           $name             = $path_name->getClientOriginalName();
           $path_name->move('images', $name);
           $receiver         = $request->receiver;

            Delivery::where('ppb_id',$id)->update([
            'path_image' => $name,
            'receiver' => $receiver,
           ]);
           return redirect('/delivery')->with('status', 'Data Has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }

    public function complete($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Delivery Success';
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Delivery Success'
        ]);
        return redirect('delivery');
    }

    public function Denied($id)
    {
        $data = CategoryPO::find($id);
        $data->status = 'Rejected By Purchasing';
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Rejected By Purchasing'
        ]);
        return redirect('menu-purchase-order');
    }

    public function export()
    {
        return Excel::download(new PembelianExport(), 'Pembelian Import.xlsx');
    }
}
