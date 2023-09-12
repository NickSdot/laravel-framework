<?php

namespace Illuminate\Tests\Console\Fixtures\Kernel\Bad\Console\Commands;

use Illuminate\Console\Command;

class NonComposerNameSpaceCommand extends Command
{
    protected $signature = 'composer:bad {id}';

    public function handle()
    {
        //
    }
}
