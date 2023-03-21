<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendWaController extends Controller
{
    public function send(){
        $pr  = CategoryPengajuanPembelian::where('status','Awaiting Purchase Request Approval')->get();
        $po  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->get();
        $pd  = CategoryPengajuanPembelian::where('status','Invoicing Process')->get();
        // $user = User::whereIn([3,6,7,8,9]);
        $url = "http://127.0.0.1:3000/send/message";

        $purchaserequest = '';

        $purchaseorder   = '';

        $paymentrequest   = '';


        foreach ($pr as $preq) {
            if ($preq->atasan == 3) {
                if(empty($preq)){
                    $purchaserequest ='-';
                }else {
                    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
                }
            } elseif($preq->atasan == 6) {
                if(empty($preq)){
                    $purchaserequest ='-';
                }else {
                    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
                }
            } elseif($preq->atasan == 7) {
                if(empty($preq)){
                    $purchaserequest ='-';
                }else {
                    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
                }
            } elseif($preq->atasan == 8) {
                if(empty($preq)){
                    $purchaserequest ='-';
                }else {
                    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
                }
            } elseif($preq->atasan == 9) {
                if(empty($preq)){
                    $purchaserequest ='-';
                }else {
                    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
                }
            }

        }
        foreach($po as $p) {
            if ($p->atasan_po == 3) {
               if (empty($p)) {
                $purchaseorder .='';
                }else {
               $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
               }
            } elseif ($p->atasan_po == 6) {
                if (empty($p)) {
                    $purchaseorder .='';
                    }else {
                   $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
                   }
            } elseif ($p->atasan_po == 7) {
                if (empty($p)) {
                    $purchaseorder .='';
                    }else {
                   $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
                   }
            } elseif ($p->atasan_po == 8) {
                if (empty($p)) {
                    $purchaseorder .='';
                    }else {
                   $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
                   }
            } elseif ($p->atasan_po == 9) {
                if (empty($p)) {
                    $purchaseorder .='';
                    }else {
                   $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
                   }
            }
            // $purchaseorder .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
        }
        foreach($pd as $pdana) {
            if ($pdana->atasan_py == 3) {
                if (empty($p)) {
                 $paymentrequest .='';
                 }else {
                $paymentrequest .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
                }
             } elseif ($pdana->atasan_py == 6) {
                 if (empty($p)) {
                     $paymentrequest .='';
                     }else {
                    $paymentrequest .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
                    }
             } elseif ($pdana->atasan_py == 7) {
                 if (empty($p)) {
                     $paymentrequest .='';
                     }else {
                    $paymentrequest .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
                    }
             } elseif ($pdana->atasan_py == 8) {
                 if (empty($p)) {
                     $paymentrequest .='';
                     }else {
                    $paymentrequest .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
                    }
             } elseif ($pdana->atasan_py == 9) {
                 if (empty($p)) {
                     $paymentrequest .='';
                     }else {
                    $paymentrequest .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
                    }
             }
            // $paymentrequest .='-'. $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
        }
        // dd($purchaserequest);

if(empty($pr)){
    $response = Http::post($url, [
'phone' => '6283805396427',
'message' => 'Here are some requests, which need your approval

----- Purchase Order ('.$pd->count().') -------
'.$purchaseorder.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po
Please Approve It ASAP

----- Payment Request ('.$pd->count().') -------
'.$paymentrequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

',]);
}elseif(empty($po)){
    $response = Http::post($url, [
'phone' => '6283805396427',
'message' => 'Here are some requests, which need your approval
----- Purchase Request ('.$pr->count().') ------
'.$purchaserequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan
Please Approve It ASAP

----- Payment Request ('.$pd->count().') -------
'.$paymentrequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

',]);
}elseif(empty($pd)){
    $response = Http::post($url, [
'phone' => '6283805396427',
'message' => 'Here are some requests, which need your approval
----- Purchase Request ('.$pr->count().') ------
'.$purchaserequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan
Please Approve It ASAP

----- Purchase Order ('.$po->count().') -------
'.$purchaseorder.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po
Please Approve It ASAP

',]);
}else {
    $response = Http::post($url, [
'phone' => '6283805396427',
'message' => 'Here are some requests, which need your approval
----- Purchase Request ('.$pr->count().') ------
'.$purchaserequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan
Please Approve It ASAP

----- Purchase Order ('.$po->count().') -------
'.$purchaseorder.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po
Please Approve It ASAP

----- Payment Request ('.$pd->count().') -------
'.$paymentrequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

',]);
}


        if ($response->ok()) {
            // Request was successful
            $responseData = $response->json();
            return response('Berhasil Send Chat');
            // Do something with $responseData
        } else {
            // Request failed
            $errorMessage = $response->body();
            // Handle the error
        }

    }
}
