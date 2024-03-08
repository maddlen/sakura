<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;

class Procfile
{
    const PROCFILE_PATH = 'Procfile';
    const HEROKU_APP_NAME_CONFIG_KEY = 'HEROKU_APP_NAME';

    public static function init(): void
    {
        $appName = config('sakura.heroku_app_name') ?? sprintf('sakura-%s-%s', Str::slug(config('app.name')), uniqid());
        $configKey = self::HEROKU_APP_NAME_CONFIG_KEY;
        $content = <<<END
# {$configKey}={$appName}
web: heroku-php-apache2 public/
END;
        File::put(static::getProcfile(), $content);
    }

    public static function getProcfile(): string
    {
        return base_path(self::PROCFILE_PATH);
    }

    public static function config(string $key): ?string
    {
        if (!File::exists(static::getProcfile())) {
            return null;
        }
        return static::extractTextFromLines(explode("\n", File::get(static::getProcfile())), $key);
    }

    private static function extractTextFromLines($lines, $key): ?string {
        $extractedText = array_values(array_map(function (string $line) use ($key) {
            $pattern = "/{$key}=(.*)$/";
            preg_match($pattern, $line, $matches);
            return (isset($matches[1])) ? trim($matches[1]) : null;
        }, $lines));

        return reset($extractedText);
    }
}
