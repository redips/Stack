<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Profiler;

use Sylius\TwigEvent\Block\EventBlock;
use Symfony\Component\Stopwatch\StopwatchEvent;

final class EventBlockProfile
{
    public function __construct (
        private string $eventBlockId,
        private EventBlock $block,
        private StopwatchEvent $stopwatchEvent,
    ) {
    }

    public function getEventBlockId(): string
    {
        return $this->eventBlockId;
    }

    public function getEventName(): string
    {
        return $this->block->getEventName();
    }

    public function getEventBlock(): EventBlock
    {
        return $this->block;
    }

    public function getDuration(): int|float
    {
        return $this->stopwatchEvent->getDuration();
    }
}
