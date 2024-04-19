<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyTrelloWebhookRequest
{
    public function handle(Request $request, Closure $next)
    {
        $hashed = base64_encode(
            hash_hmac(
                'sha1',
                $request->getContent() . route('trello.webhook-post'),
                config('app.trello_secret'),
                true
            )
        );

        if ($request->header('X-Trello-Webhook') !== $hashed) {
            abort(403, 'А ну, успокойся!');
        }

        return $next($request);
    }
}
