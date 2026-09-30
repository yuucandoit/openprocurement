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

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Request Approval')->where('id',$id)->first();
        if(!empty($pengajuan)){
                if(!empty($pengajuan->atasan)){
                    dispatch(new SendEmailPengajuanJob($pengajuan->bod->email , $id));
                    return redirect('menu-pengajuan-pembelian/')->with('status','Mail Sent Success');
                }else {
                    return redirect('menu-pengajuan-pembelian/')->with('status','PR Success Created');
                }

        }else {
            return redirect('menu-pengajuan-pembelian/')->with('status','PR Success Created');
        }

    }
}
