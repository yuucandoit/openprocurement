<?php

namespace App\Http\Controllers;

use App\Models\CategoryPB;
use App\Models\CategoryPD;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CategoryQuotation;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this_year=Carbon::now()->format('Y');
        $quotation=CategoryQuotation::where('created_at','like',$this_year.'%')->get();
        $pengajuan_dana=CategoryPD::where('created_at','like',$this_year.'%')->get();
        $pembelian_barang=CategoryPB::where('created_at','like',$this_year.'%')->get();
        $purchase_submission=CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->get();
        $purchase_order=CategoryPO::where('created_at','like',$this_year.'%')->get();
        $pengajuan  =  CategoryPengajuanPembelian::where('atasan', 6)->count();
        $po = CategoryPengajuanPembelian::where('status', 'Purchase Proses')->count();
        dd($po);
        // foreach($pengajuan as $p) {
        //     dd($p->atasan);
        // }
        //dd($pengajuan);

        for ($i=1;$i<=12;$i++){
            $data_qu[(int)$i]=0;
            $data_pd[(int)$i]=0;
            $data_pb[(int)$i]=0;
            $data_ps[(int)$i]=0;
            $data_po[(int)$i]=0;
        }
        foreach($quotation as $c){
            $check=explode('-',$c->created_at)[1];
            $data_qu[(int)$check]+=1;
        }
        foreach($pengajuan_dana as $c){
            $check=explode('-',$c->created_at)[1];
            $data_pd[(int)$check]+=1;
        }
        foreach($pembelian_barang as $c){
            $check=explode('-',$c->created_at)[1];
            $data_pb[(int)$check]+=1;
        }
        foreach($purchase_order as $c){
            $check=explode('-',$c->created_at)[1];
            $data_po[(int)$check]+=1;
        }
        foreach($purchase_submission as $c){
            $check=explode('-',$c->created_at)[1];
            $data_ps[(int)$check]+=1;
        }
        // dd($data_pb);
        // dd($data_month);
        return view('dashboard')
            ->with('data_qu', $data_qu)
            ->with('data_pd', $data_pd)
            ->with('data_pb', $data_pb)
            ->with('data_po', $data_po)
            ->with('data_ps', $data_ps)
            ->with('pengajuan', $pengajuan);

        }
    }
