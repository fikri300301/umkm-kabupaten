<?php

namespace App\Jobs;

use App\Mail\EmailTimVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailTimVerifcation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tim;
    protected $pesan;
    public function __construct($tim, $pesan)
    {
        $this->tim = $tim;
        $this->pesan = $pesan;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->tim->email_tim)->send(new EmailTimVerification($this->tim, $this->pesan));
    }
}
