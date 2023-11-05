<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\DataCollector;

use Sylius\TwigEvent\Profiler\EventBlockProfile;
use Sylius\TwigEvent\Profiler\EventProfile;
use Sylius\TwigEvent\Profiler\Profiler;
use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EventsCollector extends AbstractDataCollector
{
    /** @var array{eventProfiles: array<EventProfile>, eventBlocksProfiles: array<EventBlockProfile>} */
    protected $data = ['eventProfiles' => [], 'eventBlocksProfiles' => []];

    public function __construct (
        private Profiler $profiler,
    ) {
    }

    public function collect(Request $request, Response $response, \Throwable $exception = null): void
    {
        $this->data = $this->profiler->getAll();
    }

    public function getEventProfiles(): array
    {
        return $this->data['eventProfiles'];
    }

    public function getEventBlockProfile(string $eventBlockId): EventBlockProfile
    {
        return $this->data['eventBlocksProfiles'][$eventBlockId];
    }

    public function getNumberOfEvents(): int
    {
        return count($this->data['eventProfiles']);
    }

    public function getNumberOfEventBlocks(): int
    {
        return count($this->data['eventBlocksProfiles']);
    }

    public function getTotalRenderingTime(): float|int
    {
        return array_reduce(
            $this->data['eventProfiles'],
            static fn (float|int $accumulator, EventProfile $eventProfile): float|int => $accumulator + $eventProfile->getDuration(),
            0
        );
    }

    public static function getTemplate(): ?string
    {
        return '@TwigEvent/DataCollector/index.html.twig';
    }
}
