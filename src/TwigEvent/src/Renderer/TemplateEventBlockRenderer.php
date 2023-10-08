<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\Renderer\Exception\UnsupportedBlockException;
use Twig\Environment as Twig;

final class TemplateEventBlockRenderer implements SupportableEventBlockRendererInterface
{
    public function __construct (
        private Twig $twig,
    ) {
    }

    public function render(EventBlock $block, array $context = []): string
    {
        if (!$this->supports($block)) {
            throw new UnsupportedBlockException();
        }

        $context = array_replace($block->getContext(), $context);

        return $this->twig->render($block->getPath(), $context);
    }

    public function supports(EventBlock $block): bool
    {
        return is_a($block, TemplateEventBlock::class, true);
    }
}
