<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Sakura\Models\Init\Step;

use Maddlen\Sakura\Services\ConfigVars;

class PushConfigVars implements StepInterface
{

    public function run(): void
    {
        ConfigVars::push();
    }
}
