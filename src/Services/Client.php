<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

use HerokuClient\Client as HerokuClient;
use Illuminate\Support\Facades\App;

class Client
{
    public static function __callStatic(string $name, array $arguments)
    {
        return static::client()->$name(...$arguments);
    }

    private static function client(): HerokuClient
    {
        App::singletonIf(HerokuClient::class, fn() => new HerokuClient(['apiKey' => getenv('HEROKU_API_KEY')]));
        return App::make(HerokuClient::class);
    }

}
