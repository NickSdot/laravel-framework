<?php

namespace Illuminate\Tests\Foundation\Http;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Routing\Router;
use PHPUnit\Framework\TestCase;

class KernelRouteGroupTest extends TestCase
{
    protected $container;
    protected $router;
    protected $kernel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = new Application();
        $this->router = new Router(new Dispatcher(), $this->app);
        $this->kernel = new KernelWithMiddlewareGroupWeb($this->app, $this->router);
        $this->app->instance(\Illuminate\Contracts\Console\Kernel::class, $this->kernel);
    }

    public function testMiddlewareGroupsInRouterAndKernel()
    {
        $this->assertEquals([
            'web' => [],
        ], $this->router->getMiddlewareGroups());
        $this->assertEquals([
            'web' => [],
        ], $this->kernel->getMiddlewareGroups());
    }

    public function testKernelAppendMiddlewareToGroup()
    {
        $this->router->pushMiddlewareToGroup('web', MiddlewareA::class);

        $this->assertEquals([
            'web' => [
                MiddlewareA::class
            ]
        ], $this->router->getMiddlewareGroups());

        $this->kernel->appendMiddlewareToGroup('web', MiddlewareB::class);

        $this->assertEquals([
            'web' => [
                MiddlewareA::class,
                MiddlewareB::class
            ]
        ], $this->router->getMiddlewareGroups());
    }

    public function testKernelPrependMiddlewareToGroup()
    {
        $this->router->pushMiddlewareToGroup('web', MiddlewareA::class);

        $this->assertEquals([
            'web' => [
                MiddlewareA::class
            ]
        ], $this->router->getMiddlewareGroups());

        $this->kernel->prependMiddlewareToGroup('web', MiddlewareB::class);

        $this->assertEquals([
            'web' => [
                MiddlewareB::class,
                MiddlewareA::class,
            ]
        ], $this->router->getMiddlewareGroups());
    }

    public function testKernelAppendToMiddlewarePriority()
    {
        $this->router->pushMiddlewareToGroup('web', MiddlewareA::class);
        $this->assertEquals([
            'web' => [
                MiddlewareA::class,
            ]
        ], $this->router->getMiddlewareGroups());

        $this->kernel->appendToMiddlewarePriority(MiddlewareB::class);
        $this->assertEquals([
            'web' => [
                MiddlewareA::class,
            ],
        ], $this->router->getMiddlewareGroups());
    }

    public function testKernelPrependToMiddlewarePriority()
    {
        $this->router->pushMiddlewareToGroup('web', MiddlewareA::class);
        $this->assertEquals([
            'web' => [
                MiddlewareA::class,
            ]
        ], $this->router->getMiddlewareGroups());

        $this->kernel->prependToMiddlewarePriority(MiddlewareB::class);
        $this->assertEquals([
            'web' => [
                MiddlewareA::class,
            ],
        ], $this->router->getMiddlewareGroups());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     */
    protected function getApplication()
    {
        return new Application;
    }

    /**
     * @return \Illuminate\Routing\Router
     */
    protected function getRouter()
    {
        return new Router(new Dispatcher);
    }
}

class KernelWithMiddlewareGroupWeb extends Kernel
{
    protected $middlewareGroups = [
        'web' => [],
    ];
}

class MiddlewareA
{
    public function handle($request, $next)
    {
        return $next($request);
    }
}

class MiddlewareB
{
    public function handle($request, $next)
    {
        return $next($request);
    }
}
