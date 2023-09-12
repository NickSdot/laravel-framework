<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class TestKernel2 extends ConsoleKernel
{
    public function bootstrap(): void
    {
        $this->commands();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Bad/Console/Commands');
    }
}
