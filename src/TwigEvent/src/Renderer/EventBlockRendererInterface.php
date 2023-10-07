<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;

interface EventBlockRendererInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function render(EventBlock $block, array $context = []): string;
}
