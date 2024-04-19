<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;

/**
 *
 */
class TelegramBotController extends Controller
{
    /**
     * @return string
     */
    public function handle()
    {
        Telegram::commandsHandler(true);

        return 'ok';
    }
}
