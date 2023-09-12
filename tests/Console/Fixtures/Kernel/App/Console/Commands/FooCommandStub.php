<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel\App\Console\Commands;

use Illuminate\Console\Command;

class FooCommandStub extends Command
{
    protected $signature = 'foo:bar4 {id}';

    public function handle()
    {
        //
    }
}
