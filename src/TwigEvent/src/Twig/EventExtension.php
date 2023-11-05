<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Twig;

use Sylius\TwigEvent\Renderer\EventRendererInterface;
use Sylius\TwigEvent\Twig\Exception\NoEventProvidedException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class EventExtension extends AbstractExtension
{
    public function __construct (
        private EventRendererInterface $eventRenderer,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('twig_event', [$this, 'render'], ['is_safe' => ['html'], 'needs_context' => true,]),
        ];
    }

    /**
     * @param string|array<string> $eventName
     * @param array<string, mixed> $context
     */
    public function render(array $contextt, string|array $eventName, array $context = []): string
    {
        if (is_string($eventName)) {
            $eventName = [$eventName];
        }

        $eventName = array_filter($eventName, fn (?string $eventName) => $eventName !== null);

        if ([] === $eventName) {
            throw new NoEventProvidedException('No event name provided');
        }

        return $this->eventRenderer->render($eventName, $context);
    }
}
