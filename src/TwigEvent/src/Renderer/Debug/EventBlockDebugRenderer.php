<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer\Debug;

use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\Renderer\EventBlockRendererInterface;

final class EventBlockDebugRenderer implements EventBlockRendererInterface
{
    public function __construct (
        private EventBlockRendererInterface $eventBlockRenderer,
        private bool $debug,
    ) {
    }

    public function render(EventBlock $block, array $context = []): string
    {
        if (!$this->shouldRenderDebugComment($block)) {
            return $this->eventBlockRenderer->render($block, $context);
        }

        $renderedParts = [];
        $renderedParts[] = $this->getOpeningDebugComment($block);
        $renderedParts[] = trim($this->eventBlockRenderer->render($block, $context));
        $renderedParts[] = $this->getClosingDebugComment($block);

        return implode(PHP_EOL, $renderedParts);
    }

    private function shouldRenderDebugComment(EventBlock $block): bool
    {
        if (false === $this->debug) {
            return false;
        }

        return match (get_class($block)) {
            TemplateEventBlock::class, ComponentEventBlock::class => true,
            default => false,
        };
    }

    private function getOpeningDebugComment(EventBlock $block): string
    {
        return sprintf(
            '<!-- BEGIN BLOCK | event name: "%s", block type: "%s", block name: "%s", path: "%s", priority: %d -->',
            $block->getEventName(),
            $block->getType(),
            $block->getName(),
            $block->getPath(),
            $block->getPriority(),
        );
    }

    private function getClosingDebugComment(EventBlock $block): string
    {
        return sprintf(
            '<!-- END BLOCK | event name: "%s", block type: "%s", block name: "%s", path: "%s", priority: %d -->',
            $block->getEventName(),
            $block->getType(),
            $block->getName(),
            $block->getPath(),
            $block->getPriority(),
        );
    }
}
