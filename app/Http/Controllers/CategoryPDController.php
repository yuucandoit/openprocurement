<?php

namespace App\Http\Controllers;

use App\Models\CategoryEcommerce;
use App\Models\CategoryPD;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use App\Models\CategoryPP;
use App\Models\CategoryPT;
use App\Models\Comment;
use App\Models\Department;
use App\Models\Invoicing;
use App\Models\ItemPO;
use App\Models\PengajuanPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\WhoSubmitted;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CategoryPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5) {
            $datappb = CategoryPengajuanPembelian::where('status','Unpaid')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('pengajuanDana.menu.index')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datappb2',$datappb2)
                ->with('datapo', $datapo);
        } else if ($check->role_id == 3 || $check->role_id == 5 || $check->role_id == 2) {
            $datappb = CategoryPengajuanPembelian::where('status','Unpaid')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'in');
            $datappb2 = CategoryPengajuanPembelian::where('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('pengajuanDana.menu.index')
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
        $pengajuan          = PengajuanPembelian::where('pp_id', $id)->get();
        $datapo             = CategoryPO::where('id', $id)->get();
        $datacpo            = CategoryPO::where('id', $id)->first();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $comments           = Comment::where('ppb_id',$id)->get();

        //dd($datacpo);
        return view('pengajuanDana.menu.po')
            ->with('pengajuan', $pengajuan)
            ->with('dpp', $dpp)
            ->with('datapo', $datapo)
            ->with('dataws', $dataws)
            ->with('datacpo', $datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            // ->with('data_pengajuan', $data_pengajuan)
            ->with('comments', $comments);
    }

    public function SearchPDIn(Request $request)
    {
     $cari = $request->cariIn;
     //dd($cari);
     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10, ['*'],'in');
     return view('pengajuanDana.menu.index')
     ->with('datappb',$datappb);
    }

    public function out()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->orderBy('status', 'asc')->orderBy('dateline', 'asc')->orderBy('approved_at','asc')->paginate(10, ['*'],'out');
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('pengajuanDana.menu.out')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchPDOut(Request $request)
    {
     $cari = $request->cariOut;
     //dd($cari);

     $datappb = CategoryPengajuanPembelian::where('id','like',"%".$cari."%")
     ->orWhere('status','like',"%".$cari."%")
     ->orWhere('desc','like',"%".$cari."%")
     ->orWhereHas('whosubmit', function($q) use($cari){
          $q->where('name','like',"%".$cari."%");
     })
     ->paginate(10, ['*'],'out');

     return view('pengajuanDana.menu.out')
     ->with('datappb',$datappb);
    }


    public function history()
    {
        $check = Role::where('model_id', Auth::user()->id)->first();
        if ($check->role_id == 5 || $check->role_id == 3) {
            $datappb = CategoryPengajuanPembelian::where('status','Paid')->orWhere('status','Delivery Process')->orWhere('status','Delivery Success')->paginate(10);
            $pt = CategoryPT::all();
            $op = CategoryPP::all();
            $ec = CategoryEcommerce::all();
            $datapo = CategoryPO::all();
            return view('pengajuanDana.menu.history')
                ->with('pt',$pt)
                ->with('op',$op)
                ->with('ec',$ec)
                ->with('datappb',$datappb)
                ->with('datapo', $datapo);
        }
    }

    public function SearchHistoryPD(Request $request)
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

     return view('pengajuanDana.menu.history')
     ->with('datappb',$datappb);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail($id)
    {
        $data_pengajuan = CategoryPengajuanPembelian::find($id);
        $pengajuan = PengajuanPembelian::where('pp_id', $id)->get();
        $datacpo            = CategoryPO::where('ppb_id',$id)->first();
        $dpp                = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $ppn                = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total              = PengajuanPembelian::selectRaw('pp_id,SUM((total)+(total*11/100)) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $total_tnpa_ppn     = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $disc               = PengajuanPembelian::where('pp_id',$id)->first();
        $dataws             = WhoSubmitted::all();
        $datadepartment     = Department::all();
        $comments           = Comment::where('ppb_id',$id)->get();
        $vendor             = CategoryPO::where('ppb_id',$id)->first();
        $items              = CategoryPO::where('ppb_id',$id)->get();
        $groupedItem        = ItemPO::groupBy('po_id')->get();
        $itempurchase       = ItemPO::groupBy('po_id')->first();
        return view('pengajuanDana.menu.detail')
            ->with('pengajuan', $pengajuan)
            ->with('comments', $comments)
            ->with('dataws', $dataws)
            ->with('datacpo',$datacpo)
            ->with('datadepartment', $datadepartment)
            ->with('dpp', $dpp)
            ->with('ppn', $ppn)
            ->with('total', $total)
            ->with('disc', $disc)
            ->with('vendor', $vendor)
            ->with('items', $items)
            ->with('groupedItem', $groupedItem)
            ->with('itempurchase', $itempurchase)
            ->with('total_tnpa_ppn', $total_tnpa_ppn)
            ->with('data_pengajuan', $data_pengajuan);
    }

    public function create($id)
    {
        $dv = CategoryPengajuanPembelian::find($id);
        return view('pengajuanDana.menu.create')
            ->with('dv', $dv);
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
        $request->validate([
            'path_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           ]);

           $pengajuan        = $data->id;
           $path_name        = $request->file('path_image');
           $name             = $path_name->getClientOriginalName();
           $path_name->move('images', $name);

           $save = new CategoryPD;
           $save->ppb_id     = $pengajuan;
           $save->path_image = $name;
           $save->save();
        return redirect('menu-pengajuan-dana/')->with('success', 'Task Created Successfully!');
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
        $delete = CategoryPD::find($id);
        $delete->delete();
        return redirect('/menu-pengajuan-dana')->with('success', 'Task Deleted Successfully!');
    }

    public function paid(Request $request, $id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Paid';
        $data->p_finance_timestamp = now();
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Paid'
        ]);
        return redirect('/menu-pengajuan-dana');
    }

    public function reject($id)
    {
        $data = CategoryPengajuanPembelian::find($id);
        $data->status = 'Rejected by Finance';
        $data->p_finance_timestamp = now();
        $data->save();
        CategoryPO::where('ppb_id',$id)->update([
            'status' => 'Rejected by Finance'
        ]);
        return redirect('/menu-pengajuan-dana');
    }

    public function exportpdf($id)
    {
        $data['cpp'] = CategoryPengajuanPembelian::find($id);
        $data['cpo'] = CategoryPO::where('ppb_id', $id)->first();
        $data['id'] = PengajuanPembelian::where('pp_id', $id)->first();
        $data['sig'] = Invoicing::where('ppb_id', $id)->get()->first();
        $data['category_q'] = PengajuanPembelian::where('pp_id', $id)->get();
        $data['dpp'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total_tnp_ppn'] = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['disc'] = PengajuanPembelian::where('pp_id',$id)->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }

    public function exportpdf_multi($id)
    {
        $data['cpp']            = CategoryPengajuanPembelian::find($id);
        $data['cpo']            = CategoryPO::where('ppb_id', $id)->get();
        $data['harga']          = ItemPO::groupBy('po_id')->get();
        $data['id']             = PengajuanPembelian::where('pp_id', $id)->first();
        $data['sig']            = Invoicing::where('ppb_id', $id)->get()->first();
        $data['category_q']     = PengajuanPembelian::where('pp_id', $id)->get();
        $data['dpp']            = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['ppn']            = PengajuanPembelian::selectRaw('pp_id,SUM(total *11/100) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total']          = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['total_tnp_ppn']  = PengajuanPembelian::selectRaw('pp_id,SUM(total) as total')->groupBy('pp_id')->where('pp_id', $id)->get();
        $data['disc']           = PengajuanPembelian::where('pp_id',$id)->first();
        $data['year']           = Carbon::now()->format('y');
        $data['month']          = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment_multi', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }

    public function exportpdf_pyid($id)
    {
        $data['cpo'] = CategoryPO::find($id);
        $data['harga'] = ItemPO::where('po_id',$id)->groupBy('po_id')->get();
        // $data['sig']   = Invoicing::where('ppb_id', $id)->get()->first();
        $data['year'] = Carbon::now()->format('y');
        $data['month'] = Carbon::now()->format('m');

        $pdf = PDF::loadView('pengajuanDana.export-pdf.payment_id', $data)->setpaper('A4', 'potrait');
        return $pdf->stream('PengajuanDana.pdf');
    }
}
