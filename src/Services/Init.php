<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Services;

use Exception;
use Illuminate\Support\Collection;
use Maddlen\Sakura\Models\Init\Step\CreateApp;
use Maddlen\Sakura\Models\Init\Step\GitCreateRemote;
use Maddlen\Sakura\Models\Init\Step\EnvFile;
use Maddlen\Sakura\Models\Init\Step\GitCommit;
use Maddlen\Sakura\Models\Init\Step\GitPush;
use Maddlen\Sakura\Models\Init\Step\Procfile as Procfile;
use Maddlen\Sakura\Models\Init\Step\PushConfigVars;
use Maddlen\Sakura\Models\Init\Step\StepInterface;

class Init
{
    protected Collection $steps;
    private Collection $errors;

    public function __construct()
    {
        $this->errors = collect();
        $this->steps = collect([
            Procfile::class,
            CreateApp::class,
            EnvFile::class,
            PushConfigVars::class,
            GitCommit::class,
            GitCreateRemote::class
        ])->map(fn($step) => new $step());
    }

    public function run(): void
    {
        $this->steps->each(function (StepInterface $step) {
            try {
                $step->run();
            } catch (Exception $exception) {
                $this->errors->put(null, $exception);
            }
        });
    }

    public function getErrors(): Collection
    {
        return $this->errors;
    }
}
