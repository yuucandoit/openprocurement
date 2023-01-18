<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailPaymentJob;
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

            foreach($pengajuan as $p)
            if ($p->atasan_py == 3){

            dispatch(new SendEmailPaymentJob($p->atasanpymnt->email , $id));
            return redirect('payment_request/')->with('status','Mail Sent Success');

            }
            elseif($p->atasan_py == 6){

                dispatch(new SendEmailPaymentJob($p->atasanpymnt->email , $id));
            return redirect('payment_request/')->with('status','Mail Sent Success');

            }
            elseif($p->atasan_py == 7){

                dispatch(new SendEmailPaymentJob($p->atasanpymnt->email , $id));
            return redirect('payment_request/')->with('status','Mail Sent Success');

            }
            elseif($p->atasan_py == 8){

                dispatch(new SendEmailPaymentJob($p->atasanpymnt->email , $id));
            return redirect('payment_request/')->with('status','Mail Sent Success');

            }
            elseif($p->atasan_py == 9){

                dispatch(new SendEmailPaymentJob($p->atasanpymnt->email , $id));
            return redirect('payment_request/')->with('status','Mail Sent Success');

            }

    }
}
