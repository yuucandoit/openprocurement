<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPayment;
use App\Models\CategoryPengajuanPembelian;
use Exception;
use Illuminate\Support\Facades\Mail;

class NotifPaymentController extends Controller
{
    public function index()
    {
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Invoicing Process')->get();
        //dd($pengajuan);

        $data = [
            'subject' => 'Approval Payment Request',
            'body' => 'There are several requests waiting for your approval'
        ];
        try {
            foreach($pengajuan as $p)
            if ($p->status == 'Invoicing Process' || $p->atasan_py == 3){
            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->status == 'Invoicing Process' || $p->atasan_py == 6){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->status == 'Invoicing Process' || $p->atasan_py == 7){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->status == 'Invoicing Process' || $p->atasan_py == 8){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data));
            return redirect('payment_request/')->with('status','Mail Sent Success');
            }
            elseif($p->status == 'Invoicing Process' || $p->atasan_py == 9){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPayment($data));
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
