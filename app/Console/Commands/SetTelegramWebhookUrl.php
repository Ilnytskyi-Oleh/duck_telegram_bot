<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * SetTelegramWebhookUrl
 *
 * This command class sets the Telegram webhook URL.
 */
class SetTelegramWebhookUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-telegram-webhook-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Telegram webhook url';

    /**
     * Execute the console command.
     *
     * @throws TelegramSDKException
     */
    public function handle()
    {
        $this->info('Створюємо Вебхук для Телеграма (Дуров верни стіну!")');

        try {
            $response = Telegram::setWebhook([
                'url' => \URL::route('telegram.webhook'),
            ]);

            $this->info('Вебхук успішно створено!")');
        } catch (TelegramSDKException $e) {
            $this->error('Что-то пошло нє так: '.$e->getMessage());
            throw $e;
        }
    }
}
