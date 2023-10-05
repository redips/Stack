<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;

interface EventBlockRendererInterface
{
    public function render(EventBlock $block): string;
}
