<?php

namespace App\Jobs;

use App\Mail\NotifyLockAccountMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailLockAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;

        $this->onQueue(config('queue.names.mail'));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new NotifyLockAccountMail($this->data));
    }
}
