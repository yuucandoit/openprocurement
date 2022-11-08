<?php

namespace App\Http\Controllers;

use App\Mail\NotifApprovalPO;
use App\Models\CategoryPengajuanPembelian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotifPOController extends Controller
{
    public function index()
    {

        $pengajuan = CategoryPengajuanPembelian::where('status', 'Waiting For PO Approval')->get();

        $data = [
            'subject' => 'Approval Purchase Order',
            'body' => 'There are several requests waiting for your approval'
        ];

        try {
            foreach($pengajuan as $p)
            if ($p->status == 'Waiting For PO Approval' || Auth::user()->id === 3){
            Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Waiting For PO Approval'|| Auth::user()->id === 6){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Waiting For PO Approval'|| Auth::user()->id === 7){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Waiting For PO Approval'|| Auth::user()->id === 8){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data));
            return redirect('menu-purchase-order/')->with('status','Mail Sent Success');
            }elseif($p->status == 'Waiting For PO Approval'|| Auth::user()->id === 9){
                Mail::to('wahyusnjy@gmail.com')->send(new NotifApprovalPO($data));
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
