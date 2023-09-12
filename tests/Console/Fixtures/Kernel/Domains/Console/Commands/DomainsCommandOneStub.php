<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel\Domains\Console\Commands;

use Illuminate\Console\Command;

class DomainsCommandOneStub extends Command
{
    protected $signature = 'foo:bar1 {id}';

    public function handle()
    {
        //
    }
}
