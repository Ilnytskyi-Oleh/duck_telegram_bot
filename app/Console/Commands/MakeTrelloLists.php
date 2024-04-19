<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * Class MakeTrelloLists
 */
class MakeTrelloLists extends Command
{
    private array $trelloLists = [
        'Done',
        'InProgress',
    ];

    private string $url = 'https://api.trello.com/1/lists';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-trello-lists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Trello lists';

    /**
     * Execute the console command.
     *
     * @throws RequestException
     */
    public function handle()
    {
        $this->info('Start making Trello lists');

        foreach ($this->trelloLists as $trelloList) {
            try {
                Http::post($this->url, [
                    'name' => $trelloList,
                    'idBoard' => config('app.trello_model_id'),
                    'key' => config('app.trello_api_key'),
                    'token' => config('app.trello_api_token'),
                ]);
            } catch (RequestException $exception) {
                $this->error('Что-то пошло нє так: '.$exception->getMessage());
                throw $exception;
            }
        }

        $this->info('Done making Trello lists');
    }
}
