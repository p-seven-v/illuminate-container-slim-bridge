<?php

declare(strict_types=1);

namespace P7v\IlluminateContainerSlimBridge;

use Invoker\CallableResolver as InvokerCallableResolver;
use Slim\Interfaces\CallableResolverInterface;

final class CallableResolver implements CallableResolverInterface
{
    /** @var InvokerCallableResolver */
    private $callableResolver;

    public function __construct(InvokerCallableResolver $callableResolver)
    {
        $this->callableResolver = $callableResolver;
    }

    public function resolve($toResolve): callable
    {
        return $this->callableResolver->resolve($toResolve);
    }
}
