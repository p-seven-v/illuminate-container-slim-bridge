<?php

declare(strict_types=1);

namespace P7v\IlluminateContainerSlim;

use Illuminate\Container\Container;

abstract class ServiceProvider
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register(): void;

    /**
     * @param string $abstract
     * @param \Closure|string|null $concrete
     * 
     * @return void
     */
    protected function bind(string $abstract, $concrete = null): void
    {
        $this->container->bind($abstract, $concrete);
    }

    /**
     * @param string $abstract
     * @param \Closure|string|null $concrete
     * 
     * @return void
     */
    protected function singleton(string $abstract, $concrete = null): void
    {
        $this->container->singleton($abstract, $concrete);
    }
}
