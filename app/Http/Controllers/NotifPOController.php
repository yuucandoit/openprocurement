<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailPOJob;
use App\Mail\NotifApprovalPO;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotifPOController extends Controller
{
    public function index($id)
    {

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Waiting For PO Approval')->where('id',$id)->get();

        foreach($pengajuan as $p)
            if ( $p->atasan_po ==  3){

            dispatch(new SendEmailPOJob($p->atasans->email , $id));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');

            }elseif($p->atasan_po ==  6){

            dispatch(new SendEmailPOJob($p->atasans->email , $id));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');

            }elseif($p->atasan_po ==  7){

            dispatch(new SendEmailPOJob($p->atasans->email , $id));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');

            }elseif($p->atasan_po ==  8){

            dispatch(new SendEmailPOJob($p->atasans->email , $id));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');

            }elseif($p->atasan_po ==  9){

            dispatch(new SendEmailPOJob($p->atasans->email , $id));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            
            }

    }
}
