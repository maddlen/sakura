<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Exception;
use Maddlen\Sakura\Services\Client;
use Maddlen\Sakura\Services\HerokuApp;
use Maddlen\Sakura\Services\Procfile as Procfile;

class Buildpacks implements StepInterface
{

    public function run(): void
    {
        Client::put(
            'apps/' . HerokuApp::name() . '/buildpack-installations',
            [
                'updates' => [
                    [
                        'buildpack' => 'heroku/php'
                    ],
                    [
                        'buildpack' => 'heroku/nodejs'
                    ],
                ]
            ]
        );
    }
}
