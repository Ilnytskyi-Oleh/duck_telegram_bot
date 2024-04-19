<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitAppCommand extends Command
{
    protected $signature = 'app:run-init';

    protected $description = 'Fire all init app artisan commands';

    public function handle(): void
    {
        $this->info('Стартуєм!');

        $this->runArtisanCommand('Додаєм трело листи!', 'app:make-trello-lists');
        $this->runArtisanCommand('Додаєм Телеграм вебхук!', 'app:set-telegram-webhook-url');
        $this->runArtisanCommand('Додаємо трелло Вебхук', 'app:set-trello-webhook-url');

        $this->info('Well done, Harry!');
    }

    protected function runArtisanCommand($infoMessage, $artisanCommand): void
    {
        $this->info($infoMessage);
        \Artisan::call($artisanCommand);
        $this->info('++');
    }
}
