<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class TestKernel1 extends ConsoleKernel
{
    public function bootstrap(): void
    {
        $this->commands();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/app/Console/Commands');
        $this->load(__DIR__ . '/app/Modules/Console/Commands');
        $this->load(__DIR__ . '/Domains/Commands');
        $this->load(__DIR__ . '/Domains/Console/Commands');
    }
}
