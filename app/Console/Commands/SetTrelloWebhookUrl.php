<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use URL;
/**
 * Set Trello Webhook Url.
 */
class SetTrelloWebhookUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-trello-webhook-url';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Trello webhook url';
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Мутим вебхук для Трелло!');

        $authHeader = 'OAuth oauth_consumer_key="';
        $authHeader .= config('app.trello_api_key');
        $authHeader .= '",oauth_token="'.config('app.trello_api_token').'"';

        try {
            $response = Http::withHeaders([
                'Authorization' => $authHeader,
            ])->post('https://api.trello.com/1/webhooks', [
                'idModel' => config('app.trello_model_id'),
                'description' => 'Duck',
                'callbackURL' => URL::route('trello.webhook'),
            ]);

            if ($response->status() != '200') {
                $this->error('Что-то пошло нє так з Трелло!');
            }

            $this->info('Замутили, тепер Трелло під колпаком!');
        }
        catch (\Exception $e) {
            $this->error('Всьо прропало: ' . $e->getMessage());
        }
    }
}
