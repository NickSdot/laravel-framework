<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel\App\Modules\Console\Commands;

use Illuminate\Console\Command;

class ModulesCommandStub extends Command
{
    protected $signature = 'foo:bar3 {id}';

    public function handle()
    {
        //
    }
}
