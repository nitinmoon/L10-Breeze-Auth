<?php

namespace App\Jobs;

use App\Mail\ProductEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $attachmentPath;

    public function __construct($user, $attachmentPath)
    {
        $this->user = $user;
        $this->attachmentPath = $attachmentPath;
    }

    public function handle()
    {
        \Mail::to($this->user->email)->send(new ProductEmail($this->user, $this->attachmentPath));
    }
}
