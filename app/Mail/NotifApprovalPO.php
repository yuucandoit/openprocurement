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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


     public function build()
     {
        return $this->from('eprocurement@app.com', 'Permintaan Approval Purchase Order')
            ->subject($this->data['subject'])->view('email.purchase')
            ->with('data',$this->data);
     }
}
