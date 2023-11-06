<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Twig;

use Sylius\TwigEvent\Renderer\EventRendererInterface;
use Sylius\TwigEvent\Twig\Exception\NoEventProvidedException;
use Sylius\TwigEvent\Twig\TokenParser\HookTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\TokenParser\TokenParserInterface;
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
            new TwigFunction('get_hook_data', [$this, 'getHookData'], ['needs_context' => true]),
            new TwigFunction('get_hook_configuration', [$this, 'getHookData'], ['needs_context' => true]),
        ];
    }

    /**
     * @return array<TokenParserInterface>
     */
    public function getTokenParsers(): array
    {
        return [
            new HookTokenParser(),
        ];
    }

    /**
     * @param array{hook_data?: array<string, string>} $context
     * @return array<string, string>
     */
    public function getHookData(array $context): array
    {
        return $context['hook_data'] ?? [];
    }

    /**
     * @param array{hook_configuration?: array<string, string>} $context
     * @return array<string, string>
     */
    public function getHookConfiguration(array $context): array
    {
        return $context['hook_configuration'] ?? [];
    }

    /**
     * @param string|array<string> $eventName
     * @param array<string, mixed> $context
     */
    public function render(string|array $eventName, array $context = []): string
    {
        if (is_string($eventName)) {
            $eventName = [$eventName];
        }

        $eventName = array_filter($eventName, fn (?string $eventName) => $eventName !== null);

        if ([] === $eventName) {
            throw new NoEventProvidedException('No event name provided');
        }

        return $this->eventRenderer->render($eventName, $context) . PHP_EOL;
    }
}
