<?php

use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/' . config('app.telegram_bot_token') . '/webhook', [TelegramBotController::class, 'handle'])
->name('telegram.webhook');

Route::get('/trelloCallback', [\App\Http\Controllers\TrelloCallbackController::class, 'handle'])
    ->name('trello.webhook');
Route::post('/trelloCallback', [\App\Http\Controllers\TrelloCallbackController::class, 'handlePost'])
    ->name('trello.webhook-post')->middleware(['trello']);
