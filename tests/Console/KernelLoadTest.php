<?php

namespace Illuminate\Tests\Console;

use Illuminate\Console\Application as ConsoleApplication;
use PHPUnit\Framework\TestCase;

class KernelLoadTest extends TestCase
{
    public function testKernelsCommands()
    {
        $app = new \Illuminate\Foundation\Application(realpath(__DIR__ . '/Fixtures/Kernel'));

        $app->singleton(
            \Illuminate\Contracts\Console\Kernel::class,
            Fixtures\Kernel\TestKernel1::class
        );

        $console = new ConsoleApplication($app, $app['events'], $app->version());

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();

        foreach ($kernel->all() as $command) {
            $console->add($command);
        }

        $commands = $console->all();

        $this->assertArrayHasKey('foo:bar1', $commands);
        $this->assertArrayHasKey('foo:bar2', $commands);
        $this->assertArrayHasKey('foo:bar3', $commands);
        $this->assertArrayHasKey('foo:bar4', $commands);
    }

    public function testKernelThrowsOnNonExistingNamespace()
    {
        $this->expectException(\RuntimeException::class);

        $app = new \Illuminate\Foundation\Application(realpath(__DIR__ . '/Fixtures/Kernel'));

        $app->singleton(
            \Illuminate\Contracts\Console\Kernel::class,
            Fixtures\Kernel\TestKernel2::class
        );

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $kernel->bootstrap();
    }
}
