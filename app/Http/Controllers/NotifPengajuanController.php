<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPengajuan;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotifPengajuanController extends Controller
{
    public function index($id)
    {

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->where('id',$id)->get();
        // dd($pengajuan);
        // foreach($pengajuan as $p){
        // $item = PengajuanPembelian::where('pp_id',$p->id)->first();
        // }
        $item = PengajuanPembelian::where('pp_id',$id)->first();
        //dd($pengajuan);
        $data = [
            'subject' => 'Approval Purchase Request',
        ];

        try {
            foreach($pengajuan as $p)
            if ($p->atasan == 3){
            Mail::to('sindutest0@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 6){
                Mail::to('sindutest0@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 7){
                Mail::to('bayusolusitest@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 8){
                Mail::to('victorsolusitest@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 9){
                Mail::to('erwinsolusitest@gmail.com')->send(new NotifApprovalPengajuan($data,$pengajuan,$item));
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
