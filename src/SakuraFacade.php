<?php

namespace Maddlen\Sakura;

use Illuminate\Support\Facades\Facade;
use Maddlen\Sakura\Services\Init;

/**
 * @see Sakura
 * @method static void pushConfigVars()
 * @method static Init init()
 */
class SakuraFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sakura';
    }
}
