<?php

declare(strict_types=1);

namespace P7v\IlluminateContainerSlim;

use Generator;
use Illuminate\Container\Container;
use Invoker\CallableResolver as InvokerCallableResolver;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;

final class Bridge
{
    public static function create(Container $container = null): App
    {
        $container = $container ?? new Container();

        $callableResolver = new CallableResolver(new InvokerCallableResolver($container));

        $container->instance(CallableResolverInterface::class, $callableResolver);

        $app = AppFactory::createFromContainer($container);

        $container->instance(App::class, $app);

        $controllerInvoker = self::createControllerInvoker($container);
        $app->getRouteCollector()->setDefaultInvocationStrategy($controllerInvoker);

        return $app;
    }

    /**
     * @param string[] $providers
     *
     * @return App
     */
    public static function usingProviders(array $providers): App
    {
        $container = new Container();

        foreach (self::createProviders($providers, $container) as $provider) {
            $provider->register();
        }

        return self::create($container);
    }

    /**
     * @param array $providers
     * @param Container $container
     *
     * @return Generator
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-return Generator<int, ServiceProvider, mixed, void>
     */
    private static function createProviders(array $providers, Container $container): Generator
    {
        /** @var string $provider */
        foreach ($providers as $provider) {
            /** @var ServiceProvider */
            yield new $provider($container);
        }
    }

    private static function createControllerInvoker(ContainerInterface $container): ControllerInvoker
    {
        $resolvers = [
            // Inject parameters by name first
            new AssociativeArrayResolver(),
            // Then inject services by type-hints for those that weren't resolved
            new TypeHintContainerResolver($container),
            // Then fall back on parameters default values for optional route parameters
            new DefaultValueResolver(),
        ];

        $invoker = new Invoker(new ResolverChain($resolvers), $container);

        return new ControllerInvoker($invoker);
    }
}
