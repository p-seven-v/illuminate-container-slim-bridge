<?php

declare(strict_types=1);

namespace P7v\IlluminateContainerSlim;

use Invoker\Exception\InvocationException;
use Invoker\Exception\NotCallableException;
use Invoker\Exception\NotEnoughParametersException;
use Invoker\InvokerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

final class ControllerInvoker implements InvocationStrategyInterface
{
    /** @var InvokerInterface */
    private $invoker;

    public function __construct(InvokerInterface $invoker)
    {
        $this->invoker = $invoker;
    }

    /**
     * @param callable $callable The callable to invoke using the strategy.
     * @param ServerRequestInterface $request The request object.
     * @param ResponseInterface $response The response object.
     * @param array $routeArguments The route's placeholder arguments
     *
     * @psalm-suppress MixedInferredReturnType
     * @return ResponseInterface The response from the callable.

     * @throws InvocationException
     * @throws NotCallableException
     * @throws NotEnoughParametersException
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        // Inject the request and response by parameter name
        $parameters = [
            'request'  => $request,
            'response' => $response,
        ];
        // Inject the route arguments by name
        $parameters += $routeArguments;
        // Inject the attributes defined on the request
        $parameters += $request->getAttributes();

        /**
         * @psalm-suppress MixedReturnStatement
         */
        return $this->invoker->call($callable, $parameters);
    }
}
