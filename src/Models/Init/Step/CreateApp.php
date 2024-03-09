<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Exception;
use Maddlen\Sakura\Services\Client;
use Maddlen\Sakura\Services\HerokuApp;

class CreateApp implements StepInterface
{

    public function run(): void
    {
        $response = Client::post('apps');
        $tempApp = $response->name;
        try {
            Client::patch('apps/' . $tempApp, ['name' => HerokuApp::name()]);
        } catch (Exception $exception) { // App already exists
            Client::delete('apps/' . $tempApp);
        }
    }
}
