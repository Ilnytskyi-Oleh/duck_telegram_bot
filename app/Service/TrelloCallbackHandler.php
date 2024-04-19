<?php

namespace App\Service;

use Telegram\Bot\Laravel\Facades\Telegram;

class TrelloCallbackHandler
{
    private const CREATE_ACTION = 'createCard';
    private const UPDATE_CARD_ACTION = 'updateCard';


    /**
     * @throws \Throwable
     */
    public function handle($data)
    {
        \Log::info($data);
        if ($data['action']['type'] == self::CREATE_ACTION) {

            $viewData = [];

            $viewData['creator'] = $data['action']['memberCreator']['fullName'];
            $viewData['cardName'] = $data['action']['data']['card']['name'];
            $viewData['listName'] = $data['action']['data']['list']['name'];

            Telegram::sendMessage([
                'chat_id' => config('app.telegram_chat_id'),
                'text' => view('telegram.create', compact('viewData'))->render(),
                'parse_mode' => 'html',
            ]);

            return;
        }

        if ($data['action']['type'] == self::UPDATE_CARD_ACTION) {
            $viewData = [];

            $viewData['creator'] = $data['action']['memberCreator']['fullName'];
            $viewData['cardName'] = $data['action']['data']['card']['name'];
            $viewData['listBefore'] = $data['action']['data']['listBefore']['name'];
            $viewData['listAfter'] = $data['action']['data']['listAfter']['name'];

            Telegram::sendMessage([
                'chat_id' => config('app.telegram_chat_id'),
                'text' => view('telegram.update', compact('viewData'))->render(),
                'parse_mode' => 'html',
            ]);

        }
    }
}
