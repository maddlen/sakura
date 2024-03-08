<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

class EnvFile implements StepInterface
{

    public function run(): void
    {
        \Maddlen\Sakura\Services\EnvFile::init();
    }
}
