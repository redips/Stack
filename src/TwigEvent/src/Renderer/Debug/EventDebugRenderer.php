<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer\Debug;

use Sylius\TwigEvent\Renderer\EventRendererInterface;

final class EventDebugRenderer implements EventRendererInterface
{
    public function __construct (
        private EventRendererInterface $renderer,
        private bool $debug
    ) {
    }

    public function render(array|string $eventNames, array $context = []): string
    {
        if (!$this->shouldRenderDebugComment()) {
            return $this->renderer->render($eventNames, $context);
        }

        $renderedParts = [];
        $renderedParts[] = $this->getOpeningDebugComment($eventNames);
        $renderedParts[] = trim($this->renderer->render($eventNames, $context));
        $renderedParts[] = $this->getClosingDebugComment($eventNames);

        return implode(PHP_EOL, $renderedParts);
    }

    private function shouldRenderDebugComment(): bool
    {
        return $this->debug;
    }

    /**
     * @param string|array<string> $eventNames
     */
    private function getOpeningDebugComment(string|array $eventNames): string
    {
        return sprintf(
            '<!-- BEGIN EVENT | event name: "%s" -->',
            is_string($eventNames) ? $eventNames : implode(', ', $eventNames),
        );
    }

    /**
     * @param string|array<string> $eventNames
     */
    private function getClosingDebugComment(string|array $eventNames): string
    {
        return sprintf(
            '<!-- END EVENT | event name: "%s" -->',
            is_string($eventNames) ? $eventNames : implode(', ', $eventNames),
        );
    }
}
