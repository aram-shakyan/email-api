<?php

namespace App\Mail\Api\Email;

use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Send extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $_message;

    /**
     * Create a new message instance.
     *
     * @param string $message
     */
    public function __construct(string $message, $log_id)
    {
        $this->_message = $message;

        EmailLog::query()
            ->where("id", '=', $log_id)
            ->update(['status' => EmailLog::DELIVERED]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email.send')->with('content', $this->_message);
    }
}
