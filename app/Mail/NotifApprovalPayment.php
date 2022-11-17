<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifApprovalPayment extends Mailable
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
        return $this->from('eprocurement@app.com', 'Permintaan Approval Payment')
            ->subject($this->data['subject'])->view('email.payment')
            ->with('data',$this->data);
     }
}
