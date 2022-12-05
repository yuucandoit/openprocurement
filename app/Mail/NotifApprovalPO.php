<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifApprovalPO extends Mailable
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
        return $this->from('eprocurement@app.com', 'Permintaan Approval Purchase Order')
            ->subject($this->data['subject'])->view('email.purchase')
            ->with('data',$this->data)
            ->with('pengajuan',$this->pengajuan)
            ->with('item',$this->item);
     }
}
