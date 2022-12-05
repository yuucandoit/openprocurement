<?php

namespace App\Http\Controllers;

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

        //dd($pengajuan);
        $item = PengajuanPembelian::where('pp_id',$id)->first();

        $data = [
            'subject' => 'Approval Purchase Order',
        ];

        try {
            foreach($pengajuan as $p)
            if ( $p->atasan_po ==  3){
            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data,$pengajuan,$item));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->atasan_po ==  6){
                Mail::to('sindutest0@gmail.com')->send(new NotifApprovalPO($data,$pengajuan,$item));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->atasan_po ==  7){
                Mail::to('bayusolusitest@gmail.com')->send(new NotifApprovalPO($data,$pengajuan,$item));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->atasan_po ==  8){
                Mail::to('victorsolusitest@gmail.com')->send(new NotifApprovalPO($data,$pengajuan,$item));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->atasan_po ==  9){
                Mail::to('erwinsolusitest@gmail.com')->send(new NotifApprovalPO($data,$pengajuan,$item));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }
            else {
                return response()->json(['Sorry Something Went Wrong On Sending Email']);
            }
        } catch (Exception $th) {
            return response()->json(['Sorry Something Went Wrong']);
        }
    }
}
