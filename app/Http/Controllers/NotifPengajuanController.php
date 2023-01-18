<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailPengajuanJob;
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

        foreach($pengajuan as $p){
            // dd($p->bod->email);
            if($p->atasan == 3){
                dispatch(new SendEmailPengajuanJob($p->bod->email , $id));
                return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 6){
                dispatch(new SendEmailPengajuanJob($p->bod->email, $id));
                return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 7){
                dispatch(new SendEmailPengajuanJob($p->bod->email, $id));
                return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 8){
                dispatch(new SendEmailPengajuanJob($p->bod->email, $id));
                return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }
            elseif($p->atasan == 9){
                dispatch(new SendEmailPengajuanJob($p->bod->email, $id));
                return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
            }

        }

    }
}
