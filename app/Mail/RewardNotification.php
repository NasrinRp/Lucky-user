<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RewardNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;

    /**
     * Create a new message instance.
     *
     * @param int $amount
     * @return void
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Congratulations! You have received a reward')
            ->view('emails.reward_notification');
    }
}
