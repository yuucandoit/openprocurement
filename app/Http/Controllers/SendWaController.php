<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengajuanPembelian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendWaController extends Controller
{
    public function send(){
        $pbb = CategoryPengajuanPembelian::where('status','Waiting For PO Approval')->count();
        $user = User::find(3);
        $url = "http://127.0.0.1:3000/send/message";
        $response = Http::post($url, [
                    'phone' => '6283805396427',
                    'message' => 'Yth.Bpk '.$user->name.' Anda Memiliki Antrian Approval Sebanyak
                                Menunggu Approval Pengajuan = '.$pbb.'
                                Mohon Segera Di Approve
                                Silahkan Approve Dengan Klik Link ini',
        ]);
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
