<?php

namespace App\Jobs;

use App\Mail\NotifApprovalPayment;
use App\Models\CategoryPengajuanPembelian;
use App\Models\PengajuanPembelian;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $email;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pengajuan = CategoryPengajuanPembelian::where('status', 'Invoicing Process')->where('id',$this->id)->get();
        //dd($pengajuan);
        $item = PengajuanPembelian::where('pp_id',$this->id)->first();

        $data = [
            'subject' => 'Approval Payment Request',
        ];

            Mail::to($this->email)->send(new NotifApprovalPayment($data,$pengajuan,$item));

    }
}
