<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPengajuan;
use App\Models\CategoryPengajuanPembelian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotifPengajuanController extends Controller
{
    public function index()
    {

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->get();

        $data = [
            'subject' => 'Approval Purchase Request',
            'body' => 'There are several requests waiting for your approval'
        ];

        try {
            foreach($pengajuan as $p)
            if ($p->status == 'Awaiting Purchase Submission Approval' || $p->atasan == 3){
            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Awaiting Purchase Submission Approval' || $p->atasan == 6){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Awaiting Purchase Submission Approval' || $p->atasan == 7){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Awaiting Purchase Submission Approval' || $p->atasan == 8){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Awaiting Purchase Submission Approval' || $p->atasan == 9){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPengajuan($data));
            return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            else {
                return response()->json(['Sorry Something Went Wrong On Sending Email']);
            }
        } catch (Exception $th) {
            return response()->json(['Sorry Something Went Wrong']);
        }
    }
}
