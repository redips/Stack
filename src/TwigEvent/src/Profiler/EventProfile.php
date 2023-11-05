<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Profiler;

use Symfony\Component\Stopwatch\StopwatchEvent;

final class EventProfile
{
    /**
     * @param array<string> $eventBlocksIds
     * @param array<string> $nestedEventsIds
     */
    public function __construct (
        private string $eventId,
        private array $eventBlocksIds,
        private array $nestedEventsIds,
        private StopwatchEvent $stopwatchEvent,
    ) {
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return array<string>
     */
    public function getEventsNames(): array
    {
        return explode('#', $this->eventId);
    }

    /**
     * @return array<string>
     */
    public function getEventBlocksIds(): array
    {
        return $this->eventBlocksIds;
    }

    /** @return array<string> */
    public function getNestedEventsIds(): array
    {
        return $this->nestedEventsIds;
    }

    public function getDuration(): int|float
    {
        return $this->stopwatchEvent->getDuration();
    }
}
