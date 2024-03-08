<?php

namespace Maddlen\Sakura;

use Maddlen\Sakura\Services\ConfigVars;
use Maddlen\Sakura\Services\Init;

class Sakura
{
    public function pushConfigVars(): void
    {
        ConfigVars::push();
    }

    public function init(): Init
    {
        $init = new Init();
        $init->run();
        return $init;
    }
}
