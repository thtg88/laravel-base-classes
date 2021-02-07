<?php

namespace Thtg88\LaravelBaseClasses\Http\Controllers;

use Illuminate\Container\Container;
use Thtg88\LaravelBaseClasses\Services\ResourceServiceInterface;

class ResourceController extends Controller
{
    /**
     * The controller-specific bindings.
     *
     * @var array
     */
    protected array $bindings = [];

    /**
     * The service implementation.
     *
     * @var \App\Http\Requests\Contracts\ResourceServiceInterface
     */
    protected ResourceServiceInterface $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->addBindings();
    }

    /**
     * Return the service name.
     *
     * @return string
     */
    protected function getServiceName(): string
    {
        return $this->service->getName();
    }

    /**
     * Add controller specific bindings.
     *
     * @return void
     */
    protected function addBindings(): void
    {
        $app = Container::getInstance();

        foreach ($this->getBindings() as $abstract => $concrete) {
            $app->bind($abstract, $concrete);
        }
    }

    /**
     * Return the controller bindings.
     *
     * @return array
     */
    protected function getBindings(): array
    {
        return $this->bindings;
    }
}
