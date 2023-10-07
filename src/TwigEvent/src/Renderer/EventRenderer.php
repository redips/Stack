<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Registry\EventBlocksRegistry;

final class EventRenderer implements EventRendererInterface
{
    public function __construct (
        private EventBlocksRegistry $eventBlocksRegistry,
        private EventBlockRendererInterface $eventBlockRenderer,
    ) {
    }

    public function render(array|string $eventNames, array $context = []): string
    {
        $eventBlocks = $this->eventBlocksRegistry->getEnabledForEvent($eventNames);
        $renderedBlocks = [];

        foreach ($eventBlocks as $eventBlock) {
            $renderedBlocks[] = $this->eventBlockRenderer->render($eventBlock, $context);
        }

        return implode("\n", $renderedBlocks);
    }
}
