<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:log-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Its just testing purpose';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info("Every minute cron job testiing");
    }
}
