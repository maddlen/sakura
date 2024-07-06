<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

use Maddlen\Sakura\Services\Procfile as Procfile;

class HerokuApp
{
    public static function name(): ?string
    {
        return Procfile::config(Procfile::HEROKU_APP_NAME_CONFIG_KEY);
    }
}
