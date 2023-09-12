<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel\Domains\Commands;

use Illuminate\Console\Command;

class DomainsCommandTwoStub extends Command
{
    protected $signature = 'foo:bar2 {id}';

    public function handle()
    {
        //
    }
}
