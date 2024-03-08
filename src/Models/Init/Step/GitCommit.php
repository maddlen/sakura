<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Exception;
use Illuminate\Support\Facades\Process;
use Maddlen\Sakura\Exceptions\GitException;
use Maddlen\Sakura\Services\EnvFile as EnvFile;
use Maddlen\Sakura\Services\Procfile as Procfile;

class GitCommit implements StepInterface
{

    public function run(): void
    {
        try {
            $files = collect([Procfile::getProcfile(), EnvFile::getEnvFile()]);
            $files->each(fn($file) => Process::run("git add {$file}"));
            Process::run("git commit -m 'Heroku setup'");
        } catch (Exception $e) {
            throw new GitException('Failed committing to Git. Please commit the changes manually and push to Heroku.');
        }
    }
}
