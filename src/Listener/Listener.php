<?php

namespace Geo6\Expressive\Sentry\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Sentry\captureException;
use function Sentry\init;
use Sentry\State\Scope;
use function Sentry\withScope;
use Throwable;

class Listener
{
    /** @var array */
    private $config;

    /** @var bool */
    private $enabled;

    public function __construct(array $config, bool $enabled = true)
    {
        $this->config = $config;
        $this->enabled = $enabled;

        init($this->config);
    }

    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response): void
    {
        withScope(function (Scope $scope) use ($error) {
            $scope->setExtra('file', $error->getFile());
            $scope->setExtra('line', $error->getLine());
            $scope->setExtra('code', $error->getCode());

            captureException($error);
        });
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
