<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer\Exception;

class NoSupportedRendererException extends \RuntimeException
{
    public function __construct (
        string $eventName,
        string $blockName,
        string $message = 'No supported renderer found for event "%s" and block "%s".',
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                $message,
                $eventName,
                $blockName
            ),
            $code,
            $previous
        );
    }
}
