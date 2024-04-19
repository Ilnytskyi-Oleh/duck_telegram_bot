<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class GetWebhookUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-webhook-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GEt Telegram webhook url';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Telegram::getWebhookInfo();

        echo $response . PHP_EOL;
    }
}
