<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPengajuan;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotifPengajuanController extends Controller
{
    public function index($id)
    {

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('id',$id)->get();
        // dd($pengajuan);
        // foreach($pengajuan as $p){
        // $item = PengajuanPembelian::where('pp_id',$p->id)->first();
        // }

        $url = "http://127.0.0.1:3000/send/message";

        $item = PengajuanPembelian::where('pp_id',$id)->first();
        //dd($pengajuan);
        $data = [
            'subject' => 'Approval Purchase Request',
        ];

        try {
            foreach($pengajuan as $p)
            if ($p->atasan == 3){
            $response = Http::post($url, [
                    'phone' => '6289618786152',
                    'message' => 'Testt',
            ]);

            // print_r($response);

            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 6){
            $response = Http::post($url, [
                    'phone' => '-no pa sindu-',
                    'message' => 'Test Approval Pengajuan Pembelian',
            ]);
            Mail::to('sindu@intek.co.id')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 7){
            $response = Http::post($url, [
                    'phone' => '-no pa bayu-',
                    'message' => 'Test Approval Pengajuan Pembelian',
            ]);
                Mail::to('bayu@intek.co.id')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 8){
            $response = Http::post($url, [
                    'phone' => '-no pa victor-',
                    'message' => 'Test Approval Pengajuan Pembelian',
            ]);
                Mail::to('victor@intek.co.id')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 9){
            $response = Http::post($url, [
                    'phone' => '-no pa erwin-',
                    'message' => 'Test Approval Pengajuan Pembelian',
            ]);
                Mail::to('erwin@intek.co.id')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            else {
                return response()->json(['Sorry Something Went Wrong On Sending Email']);
            }
        } catch (Exception $err) {
            dd($err);
            return response()->json(['Sorry Something Went Wrong']);
        }
    }
}
