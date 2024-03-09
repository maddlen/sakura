<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Exception;
use Illuminate\Support\Facades\Process;
use Maddlen\Sakura\Exceptions\GitException;
use Maddlen\Sakura\Services\Client;
use Maddlen\Sakura\Services\HerokuApp;

class GitCreateRemote implements StepInterface
{

    public function run(): void
    {
        try {
            $gitUrl = Client::get('apps/' . HerokuApp::name())->git_url;
            Process::run("git remote add heroku {$gitUrl}");
        } catch (Exception $e) {
            throw new GitException('Failed creating Heroku remote to Git. Please create the remote manually.');
        }
    }
}
