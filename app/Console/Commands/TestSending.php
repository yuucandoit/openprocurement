<?php

namespace App\Console\Commands;

use App\Models\CategoryPengajuanPembelian;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestSending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Sending WA';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $po1  = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->where('atasan_po',24)->get();
        $pd1  = CategoryPengajuanPembelian::where('status','Invoicing Process')->where('atasan_py',24)->get();
        $url = "http:/127.0.0.1:3000/send/message";
        $purchaseorder1   = '';
        $paymentrequest1   = '';

//Bu yani
foreach($po1 as $p) {
if ($p->atasan_po == 24) {
if (empty($p)) {
$purchaseorder1 .='';
$pesanpo = $p;
}
else    {
$purchaseorder1 .='-'.  $p->code_pengajuan.' '. $p->whosubmit->name ."\n";
$pesanpo = $p;
        }
    }
}

if ($po1->count() == 0){

}else {
$response = Http::post($url, [
    'phone' => '6289618786152',
'message' => '
----- Purchase Order ('.$po1->count().') -------
'.$purchaseorder1.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-po

This message was sent automatically, please do not reply.

',]);
}



//Start Notif WA Bu yani
foreach($pd1 as $pdana) {
if ($pdana->atasan_py == 24) {
if (empty($p)) {
$paymentrequest1 .='';
$pesanpd = $pdana;
}else {
$paymentrequest1 .='-'.  $pdana->code_pengajuan.' '. $pdana->whosubmit->name ."\n";
$pesanpd = $pdana;
        }
    }
}
if ($pd1->count() == 0){

}else{
$response = Http::post($url, [
    'phone' => '6289618786152',
'message' => '
----- Payment Request ('.$pd1->count().') -------
'.$paymentrequest1.'
Link : https://e-pro.intek.co.id/menu-taskList-atasan-payment
Please Approve It ASAP

This message was sent automatically, please do not reply.

',]);
}


//End Notif Wa Bu yani

echo('Success send!');

        return Command::SUCCESS;
    }
}
