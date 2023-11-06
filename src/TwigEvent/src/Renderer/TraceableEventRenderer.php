<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Profiler\EventProfile;
use Sylius\TwigEvent\Profiler\Profiler;
use Symfony\Component\Stopwatch\Stopwatch;

final class TraceableEventRenderer implements EventRendererInterface
{
    public function __construct (
        private EventRendererInterface $decorated,
        private Profiler $profiler,
        private ?Stopwatch $stopwatch,
        private bool $debug,
    ) {
    }

    public function render(array|string $eventNames, array $context = []): string
    {
        if (!$this->debug) {
            return $this->decorated->render($eventNames, $context);
        }

        $eventId = sprintf('%s', is_string($eventNames) ? $eventNames : implode('#', $eventNames));
        $this->stopwatch?->start($eventId);

        $result = $this->decorated->render($eventNames, $context);

        preg_match_all('/<!-- BEGIN BLOCK[^>]+event name: "([^"]+)",[^>]+block name: "([^"]+)"/', $result, $matchedEventBlocks);

        $blocksIds = array_map(function($eventName, $blockName): string {
            return sprintf('%s#%s', $eventName, $blockName);
        }, $matchedEventBlocks[1], $matchedEventBlocks[2]);
        $blocksIds = array_filter($blocksIds, function (string $blockId) use ($eventNames): bool {
            $eventName = explode('#', $blockId)[0];

            return in_array($eventName, is_string($eventNames) ? [$eventNames] : $eventNames, true);
        });

        preg_match_all('/<!-- BEGIN EVENT[^>]+event name: "([^"]+)"/', $result, $matchedEvents);
        $eventsIds = array_map(function($eventName): string {
            return str_replace(', ', '#', $eventName);
        }, $matchedEvents[1]);
        $eventsIds = array_diff($eventsIds, [$eventId]);

        $this->profiler->addEventProfile(new EventProfile(
            $eventId,
            $blocksIds,
            $eventsIds,
            $this->stopwatch?->stop($eventId),
        ));

        return $result;
    }
}
