<?php

namespace App\Telegram\Commands;

use App\Models\TelegramUser;
use Telegram\Bot\Commands\Command;

/**
 *
 */
class StartCommand extends Command
{
    protected string $name = 'start';

    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        $message = $this->telegram
            ->getWebhookUpdate()
            ->getMessage();

        \Log::info($this->telegram
            ->getWebhookUpdate());

        try {
            \DB::beginTransaction();

            TelegramUser::firstOrCreate(
                ['telegram_id' => $message['from']['id']],
                [
                    'username' => $message['from']['username'],
                    'last_name' => $message['from']['username'],
                    'first_name' => $message['from']['username'],
                    'language_code' => $message['from']['language_code'] ?? null,
                    'is_bot' => $message['from']['is_bot'],
                ]
            );

            \DB::commit();

            $viewData = [];
            $viewData['username'] = $message->from->first_name;

            $this->replyWithMessage([
                'text' => view('telegram.start', compact('viewData'))->render(),
                'parse_mode' => 'html',
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();

            $this->replyWithMessage([
                'text' => 'Что-то пошло нє так!',
            ]);
        }
    }
}
