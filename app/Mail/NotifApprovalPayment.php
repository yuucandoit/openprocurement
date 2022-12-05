<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifApprovalPayment extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    public $pengajuan;
    public $item;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$pengajuan,$item)
    {
        $this->data = $data;
        $this->pengajuan = $pengajuan;
        $this->item      = $item;
    }


     public function build()
     {
        return $this->from('eprocurement@app.com', 'Permintaan Approval Payment')
            ->subject($this->data['subject'])->view('email.payment')
            ->with('data',$this->data)
            ->with('pengajuan',$this->pengajuan)
            ->with('item',$this->item);
     }
}
