<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

use Dotenv\Dotenv;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maddlen\Sakura\Exceptions\MissingEnvFileException;

class EnvFile
{
    public static function init(): void
    {
        File::put(static::getEnvFile(), sprintf('APP_KEY=%s', config('app.key')));
    }

    public static function getEnvFile(): string
    {
        return base_path(config('sakura.env_file'));
    }

    public static function parse(?int $chunkSize = null): Collection
    {
        if (!File::exists(static::getEnvFile())) {
            throw new MissingEnvFileException();
        }
        $all = collect(Dotenv::parse(file_get_contents(static::getEnvFile())));
        return ($chunkSize) ? $all->chunk($chunkSize) : $all;
    }
}
