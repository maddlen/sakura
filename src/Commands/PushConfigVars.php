<?php

namespace Maddlen\Sakura\Commands;

use Illuminate\Console\Command;
use Maddlen\Sakura\Exceptions\MissingEnvFileException;
use Maddlen\Sakura\SakuraFacade;

class PushConfigVars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sakura:push-config-vars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push .env.heroku to Heroku Config Vars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            SakuraFacade::pushConfigVars();
        } catch (MissingEnvFileException $exception) {
            $this->info('Please create a .env.heroku file at the root of the project.');
            $this->warn('Make sure to populate it with your APP_KEY.');
            return;
        }
    }
}
