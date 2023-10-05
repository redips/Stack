<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;

interface SupportableEventBlockRendererInterface extends EventBlockRendererInterface
{
    public function supports(EventBlock $block): bool;
}
