<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

interface TwigEventRendererInterface
{
    /**
     * @param string|array<string> $eventNames
     * @param array<string, mixed> $context
     */
    public function render(string|array $eventNames, array $context = []): string;
}
