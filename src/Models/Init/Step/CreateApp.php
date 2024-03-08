<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Exception;
use Maddlen\Sakura\Services\Client;
use Maddlen\Sakura\Services\Procfile as Procfile;

class CreateApp implements StepInterface
{

    public function run(): void
    {
        $response = Client::post('apps');
        $tempApp = $response->name;
        try {
            Client::patch('apps/' . $tempApp, ['name' => Procfile::config(Procfile::HEROKU_APP_NAME_CONFIG_KEY)]);
        } catch (Exception $exception) { // App already exists
            Client::delete('apps/' . $tempApp);
        }
    }
}
