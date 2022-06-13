<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticeExpirySubscribe extends Mailable
{
    use Queueable, SerializesModels;

    public Vendor $vendor;
    public $diff;

    /**
     * NoticeExpirySubscribe constructor.
     * @param Vendor $vendor
     * @param $diff
     */
    public function __construct(Vendor $vendor, $diff)
    {
        $this->vendor = $vendor;
        $this->diff = $diff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notice_expiry_subscribe');
    }
}
