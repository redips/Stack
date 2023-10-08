<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Renderer\Exception\UnsupportedBlockException;
use Symfony\UX\TwigComponent\ComponentRendererInterface;

final class ComponentEventBlockRenderer implements SupportableEventBlockRendererInterface
{
    public function __construct (
        private ComponentRendererInterface $componentRenderer,
    ) {
    }

    public function render(EventBlock $block, array $context = []): string
    {
        if (!$this->supports($block)) {
            throw new UnsupportedBlockException();
        }

        $mergedContext = array_replace($block->getContext(), $context);
        $mergedContext['context'] = $mergedContext;

        return $this->componentRenderer->createAndRender($block->getPath(), $mergedContext);
    }

    public function supports(EventBlock $block): bool
    {
        return is_a($block, ComponentEventBlock::class, true);
    }
}
