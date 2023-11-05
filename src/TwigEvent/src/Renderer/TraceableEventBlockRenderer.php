<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Profiler\EventBlockProfile;
use Sylius\TwigEvent\Profiler\Profile;
use Sylius\TwigEvent\Profiler\Profiler;
use Symfony\Component\Stopwatch\Stopwatch;

final class TraceableEventBlockRenderer implements EventBlockRendererInterface
{
    public function __construct (
        private EventBlockRendererInterface $decorated,
        private Stopwatch $stopwatch,
        private Profiler $profiler,
        private bool $debug,
    ) {
    }

    public function render(EventBlock $block, array $context = []): string
    {
        if (!$this->debug) {
            return $this->decorated->render($block, $context);
        }

        $eventId = sprintf('%s#%s', $block->getEventName(), $block->getName());
        $this->stopwatch->start($eventId);

        $result = $this->decorated->render($block, $context);

        $profile = new EventBlockProfile(
            $eventId,
            $block,
            $this->stopwatch->stop($eventId),
        );
        $this->profiler->addEventBlockProfile($profile);

        return $result;
    }
}
