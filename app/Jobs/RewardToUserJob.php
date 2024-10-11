<?php

namespace App\Jobs;

use App\Mail\RewardNotification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RewardToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user;
    protected $amount;

    public function __construct(User $user, Int $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wallet = $this->user->wallet;

        if ($wallet) {
            $wallet->update([
                'amount' => $wallet->amount + $this->amount,
            ]);

            Mail::to($this->user->email)->send(new RewardNotification($this->amount));
        } else {
            throw new \Exception('Wallet not found for user ID: ' . $this->user->id);
        }
    }

}
