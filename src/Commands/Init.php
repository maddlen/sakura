<?php

namespace Maddlen\Sakura\Commands;

use Exception;
use Illuminate\Console\Command;
use Maddlen\Sakura\Exceptions\WarningException;
use Maddlen\Sakura\SakuraFacade;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sakura:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Heroku environment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $init = SakuraFacade::init();
        $isSuccess = $init->getErrors()->filter(fn (Exception $error) => !$error instanceof WarningException)->isEmpty();
        if ($isSuccess) {
            $this->info('Heroku environment initialized successfully.');
            $this->warn('Please push to Heroku to deploy. Ex: git push heroku master');
        }
        $init->getErrors()->each(function (Exception $error) {
            if ($error instanceof WarningException) {
                $this->warn($error->getMessage());
            } else {
                throw $error;
            }
        });
    }
}
