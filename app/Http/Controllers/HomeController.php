<?php

namespace App\Http\Controllers;

use App\Models\CategoryPB;
use App\Models\CategoryPD;
use App\Models\CategoryPengajuanPembelian;
use App\Models\CategoryPO;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CategoryQuotation;
use App\Models\Invoicing;
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
        $this_year           = Carbon::now()->format('Y');
        $quotation           = CategoryQuotation::where('created_at','like',$this_year.'%')->get();
        $pengajuan_dana      = CategoryPD::where('created_at','like',$this_year.'%')->get();
        $pembelian_barang    = CategoryPB::where('created_at','like',$this_year.'%')->get();
        $purchase_submission = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->get();
        $purchase_order      = CategoryPO::where('created_at','like',$this_year.'%')->get();
        $taskpo              = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status','!=','Purchase Request Approved')->get();
        $pengajuan           = CategoryPengajuanPembelian::where('atasan', 6)->count();
        $pr_pending          = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status', 'Awaiting Purchase Request Approval')->get();
        $pr_success          = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status', 'Delivery Success')->get();
        $pr_fail             = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")->get();
        $pr_pending_count    = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status', 'Awaiting Purchase Request Approval')->count();
        $pr_success_count    = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status', 'Delivery Success')->count();
        $pr_fail_count       = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")->count();
        $task_bod_pr         = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('atasan',Auth::user()->id)->where('status', '!=' ,'Awaiting Purchase Request Approval')->get();
        $task_bod_po         = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('atasan_po',Auth::user()->id)->get();
        $task_bod_py         = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('atasan_py',Auth::user()->id)->get();
        $payment_request     = Invoicing::where('created_at','like',$this_year.'%')->get();
        $delivery            = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status', 'Delivery Success')->get();
        $task_finance        = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status', '!=','Payment Approved')->get();
        $payment_process     = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status','Paid' && 'Delivery Success')->get();
        $delivery            = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status', 'Delivery Success')->get();
        $logistCheck         = CategoryPengajuanPembelian::where('created_at','like',$this_year.'%')->where('status', 'Awaiting Purchase Request Approval')->where('logistic_check', 1)->get();


        for ($i=1;$i<=12;$i++){
            $data_qu[(int)$i]=0;
            $data_pd[(int)$i]=0;
            $data_pb[(int)$i]=0;
            $data_ps[(int)$i]=0;
            $data_po[(int)$i]=0;
            $data_task_po[(int)$i]=0;
            $data_pndng[(int)$i]=0;
            $data_success[(int)$i]=0;
            $data_fail[(int)$i]=0;
            $taskBodPR [(int)$i]=0;
            $taskBodPO [(int)$i]=0;
            $taskBodPY [(int)$i]=0;
            $data_pymntreq [(int)$i]=0;
            $data_delivery [(int)$i]=0;
            $taskFinance [(int)$i]=0;
            $data_pp [(int)$i]=0;
            $data_checkInven [(int)$i]=0;
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
        foreach($taskpo as $c){
            $check=explode('-',$c->created_at)[1];
            $data_task_po[(int)$check]+=1;
        }
        foreach($purchase_order as $c){
            $check=explode('-',$c->created_at)[1];
            $data_po[(int)$check]+=1;
        }
        foreach($purchase_submission as $c){
            $check=explode('-',$c->created_at)[1];
            $data_ps[(int)$check]+=1;
        }
        foreach($pr_pending as $c){
            $check=explode('-',$c->created_at)[1];
            $data_pndng[(int)$check]+=1;
        }
        foreach($pr_success as $c){
            $check=explode('-',$c->created_at)[1];
            $data_success[(int)$check]+=1;
        }
        foreach($pr_fail as $c){
            $check=explode('-',$c->created_at)[1];
            $data_fail[(int)$check]+=1;
        }
        foreach($task_bod_pr as $c){
            $check=explode('-',$c->created_at)[1];
            $taskBodPR[(int)$check]+=1;
        }
        foreach($task_bod_po as $c){
            $check=explode('-',$c->created_at)[1];
            $taskBodPO[(int)$check]+=1;
        }
        foreach($task_bod_py as $c){
            $check=explode('-',$c->created_at)[1];
            $taskBodPY[(int)$check]+=1;
        }
        foreach($payment_request as $c){
            $check=explode('-',$c->created_at)[1];
            $data_pymntreq[(int)$check]+=1;
        }
        foreach($delivery as $c){
            $check=explode('-',$c->created_at)[1];
            $data_delivery[(int)$check]+=1;
        }
        foreach($task_finance as $c){
            $check=explode('-',$c->created_at)[1];
            $taskFinance[(int)$check]+=1;
        }
        foreach($payment_process as $c){
            $check=explode('-',$c->created_at)[1];
            $data_pp[(int)$check]+=1;
        }

        foreach($logistCheck as $lc){
            $check=explode('-',$lc->created_at)[1];
            $data_checkInven[(int)$check]+=1;
        }
        // dd($data_pb);
        // dd($data_month);
        return view('dashboard')
            ->with('data_qu', $data_qu)
            ->with('data_pd', $data_pd)
            ->with('data_pb', $data_pb)
            ->with('data_po', $data_po)
            ->with('data_task_po', $data_task_po)
            ->with('data_ps', $data_ps)
            ->with('data_pndng', $data_pndng)
            ->with('data_success', $data_success)
            ->with('data_fail', $data_fail)
            ->with('taskBodPR', $taskBodPR)
            ->with('taskBodPO', $taskBodPO)
            ->with('taskBodPY', $taskBodPY)
            ->with('pengajuan', $pengajuan)
            ->with('data_pymntreq', $data_pymntreq)
            ->with('data_delivery', $data_delivery)
            ->with('taskFinance', $taskFinance)
            ->with('data_pp', $data_pp)
            ->with('pr_pending_count', $pr_pending_count)
            ->with('pr_success_count', $pr_success_count)
            ->with('pr_fail_count', $pr_fail_count)
            ->with('data_checkInven', $data_checkInven);

        }
    }
