<?php

namespace App\Console\Commands;

use App\Models\CategoryPengajuanPembelian;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendNotifikasiBOD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification Via WhatsApp to BOD';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pr  = CategoryPengajuanPembelian::where('status','Awaiting Purchase Request Approval')->where('atasan', 7)->get();

        $po1  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->where('atasan_po',3)->get();
        $po2  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->where('atasan_po',6)->get();
        $po3  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->where('atasan_po',8)->get();
        $po4  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->where('atasan_po',9)->get();

        $pd1  = CategoryPengajuanPembelian::where('status','Invoicing Process')->where('atasan_py',3)->get();
        $pd2  = CategoryPengajuanPembelian::where('status','Invoicing Process')->where('atasan_py',6)->get();
        $pd3  = CategoryPengajuanPembelian::where('status','Invoicing Process')->where('atasan_py',8)->get();
        $pd4  = CategoryPengajuanPembelian::where('status','Invoicing Process')->where('atasan_py',9)->get();
        // $user = User::whereIn([3,6,7,8,9]);
        $url = "https://wa.chat-farm.com/send/message";

        $purchaserequest = '';

        $purchaseorder1   = '';
        $purchaseorder2   = '';
        $purchaseorder3   = '';
        $purchaseorder4   = '';

        $paymentrequest1   = '';
        $paymentrequest2   = '';
        $paymentrequest3   = '';
        $paymentrequest4   = '';

// Start Puchase Request Cuma ke pak bayu
foreach ($pr as $preq) {
if(empty($preq)){
    $purchaserequest ='-';
}else {
    $purchaserequest .='-'.  $preq->code_pengajuan.' '. $preq->whosubmit->name ."\n";
    }
}
$response = Http::post($url, [
'phone' => '447509758689',
'message' => 'Here are some requests, which need your approval

----- Purchase Request ('.$pr->count().') -------
'.$purchaserequest.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan

This message was sent automatically, please do not reply.
',]);
//End Purchase Request


// Start Purchase Order Cuma ke bu yani/ pak sindu / pak victor

//Bu yani
foreach($po1 as $p) {
if ($p->atasan_po == 3) {
if (empty($p)) {
$purchaseorder1 .='';
}
else    {
$purchaseorder1 .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '12203453438',
'message' => '
----- Purchase Order ('.$po1->count().') -------
'.$purchaseorder1.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po

This message was sent automatically, please do not reply.

',]);
//End Notif PO Bu yani

//Pak Sindu
foreach($po2 as $p) {
if ($p->atasan_po == 6) {
if (empty($p)) {
$purchaseorder2 .='';
    }
else {
$purchaseorder2 .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '447509758634',
'message' => '
----- Purchase Order ('.$po2->count().') -------
'.$purchaseorder2.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po

This message was sent automatically, please do not reply.

',]);

//End Notif WA Pak sindu


//Start Notif WA Pak Victor
foreach($po3 as $p) {
if ($p->atasan_po == 8) {
if (empty($p)) {
$purchaseorder3 .='';
}
else {
$purchaseorder3 .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '447937598025',
'message' => '
----- Purchase Order ('.$po3->count().') -------
'.$purchaseorder3.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po

This message was sent automatically, please do not reply.

',]);
//End Notif WA Pak Victor

//Start Notif WA Pak Erwin
foreach($po4 as $p) {
if ($p->atasan_po == 9) {
if (empty($p)) {
$purchaseorder4 .='';
}
else {
$purchaseorder4 .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '6285161273864',
'message' => '
----- Purchase Order ('.$po4->count().') -------
'.$purchaseorder4.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po

This message was sent automatically, please do not reply.

',]);
//End Notif WA Pak Erwin

//End Purchase Order


//Pengajuan dana Cuma ke bu yani/ pak sindu / pak victor

//Start Notif WA Bu yani
foreach($pd1 as $pdana) {
if ($pdana->atasan_py == 3) {
if (empty($p)) {
$paymentrequest1 .='';
}else {
$paymentrequest1 .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '12203453438',
'message' => '
----- Payment Request ('.$pd1->count().') -------
'.$paymentrequest1.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

This message was sent automatically, please do not reply.

',]);

//End Notif Wa Bu yani

//Start Notif Wa pak Sindu
foreach($pd2 as $pdana) {
if ($pdana->atasan_py == 6) {
if (empty($p)) {
$paymentrequest2 .='';
}
else {
$paymentrequest2 .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '447509758634',
'message' => '
----- Payment Request ('.$pd2->count().') -------
'.$paymentrequest2.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

This message was sent automatically, please do not reply.

',]);

//End Notif WA Pak Sindu

//Start Notif Pak Victor

foreach($pd3 as $pdana) {
if ($pdana->atasan_py == 8) {
if (empty($p)) {
$paymentrequest3 .='';
}else {
$paymentrequest3 .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
        }
    }
}
$response = Http::post($url, [
    'phone' => '447937598025',
'message' => '
----- Payment Request ('.$pd3->count().') -------
'.$paymentrequest3.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

This message was sent automatically, please do not reply.

',]);

//End Notif Pak Victor

//Start Notif Pak Erwin

foreach($pd4 as $pdana) {
    if ($pdana->atasan_py == 9) {
    if (empty($p)) {
    $paymentrequest4 .='';
    }else {
    $paymentrequest4 .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
            }
        }
    }
    $response = Http::post($url, [
        'phone' => '6285161273864',
'message' => '
----- Payment Request ('.$pd3->count().') -------
'.$paymentrequest4.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

This message was sent automatically, please do not reply.

',]);

//End Notif Pak Erwin

//End Pengajuan Dana

        echo "Success Send Notif To WhatsApp";
        return Command::SUCCESS;
    }
}
