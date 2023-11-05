<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Profiler;

/** @internal */
final class Profiler
{
    /** @var array<EventProfile> */
    private array $eventsProfiles = [];

    /** @var array<EventBlockProfile> */
    private array $eventBlocksProfiles = [];

    public function addEventProfile(EventProfile $eventProfile): void
    {
        $this->eventsProfiles[$eventProfile->getEventId()] = $eventProfile;
    }

    public function addEventBlockProfile(EventBlockProfile $eventBlockProfile): void
    {
        $this->eventBlocksProfiles[$eventBlockProfile->getEventBlockId()] = $eventBlockProfile;
    }

    /**
     * @return array<EventProfile>
     */
    public function getEventProfiles(): array
    {
        return $this->eventsProfiles;
    }

    /**
     * @return array<EventBlockProfile>
     */
    public function getEventBlockProfiles(): array
    {
        return $this->eventBlocksProfiles;
    }

    /**
     * @return array{eventProfiles: array<EventProfile>, eventBlocksProfiles: array<EventBlockProfile>}
     */
    public function getAll(): array
    {
        return [
            'eventProfiles' => $this->eventsProfiles,
            'eventBlocksProfiles' => $this->eventBlocksProfiles,
        ];
    }

    public function reset(): void
    {
        $this->eventsProfiles = [];
        $this->eventBlocksProfiles = [];
    }
}
