<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

class ConfigVars
{
    private string $path = '';

    public function __construct()
    {
        $this->path = sprintf('apps/%s/config-vars', HerokuApp::name());
    }

    public static function push(): void
    {
        $configVars = new static();
        $configVars->doPush();
    }

    protected function doPush(): void
    {
        $this->clear();
        $this->pushFromEnvFile();
    }

    private function clear(): void
    {
        $currentConfigVars = collect(Client::get($this->path));
        if ($currentConfigVars->count()) {
            $emptyConfigVars = collect();
            $currentConfigVars->each(fn($value, $key) => $emptyConfigVars->put($key, null));
            Client::patch($this->path, $emptyConfigVars->all());
        }
    }

    private function pushFromEnvFile(): void
    {
        $envVars = EnvFile::parse();
        Client::patch($this->path, $envVars->all());
    }
}
