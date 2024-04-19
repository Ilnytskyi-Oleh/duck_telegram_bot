<?php

namespace App\Http\Controllers;

use App\Service\TrelloCallbackHandler;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 *
 */
class TrelloCallbackController extends Controller
{

    private TrelloCallbackHandler $service;

    public function __construct(TrelloCallbackHandler $service)
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function handle(Request $request)
    {
        return response('', 200);
    }

    public function handlePost(Request $request)
    {
        $data = $request->all();

        $this->service->handle($data);

        return response('', 200);
    }
}
