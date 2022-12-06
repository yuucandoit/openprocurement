<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPayment;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use Exception;
use Illuminate\Support\Facades\Mail;

class NotifPaymentController extends Controller
{
    public function index($id)
    {
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Invoicing Process')->where('id',$id)->get();
        //dd($pengajuan);
        $item = PengajuanPembelian::where('pp_id',$id)->first();

        $data = [
            'subject' => 'Approval Payment Request',
        ];
        try {
            foreach($pengajuan as $p)
            if ($p->atasan_py == 3){
            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data,$pengajuan,$item));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan_py == 6){
                Mail::to('sindu@intek.co.id')->send(new NotifApprovalPayment($data,$pengajuan,$item));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan_py == 7){
                Mail::to('bayu@intek.co.id')->send(new NotifApprovalPayment($data,$pengajuan,$item));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan_py == 8){
                Mail::to('victor@intek.co.id')->send(new NotifApprovalPayment($data,$pengajuan,$item));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan_py == 9){
                Mail::to('erwin@intek.co.id')->send(new NotifApprovalPayment($data,$pengajuan,$item));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            else {
                return response()->json(['Sorry Something Went Wrong On Sending Email']);
            }
        } catch (Exception $th) {
            return response()->json(['Sorry Something Went Wrong']);
        }
    }
}
