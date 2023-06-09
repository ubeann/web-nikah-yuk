<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected string $resetPasswordUrl;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $resetPasswordUrl)
    {
        $this->user = $user;
        $this->resetPasswordUrl = $resetPasswordUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send('emails.reset-password', [
            'user' => $this->user,
            'resetPasswordUrl' => $this->resetPasswordUrl,
        ], function ($message) {
            $message->to($this->user->email, $this->user->name)->subject('Reset Password');
        });
    }
}
