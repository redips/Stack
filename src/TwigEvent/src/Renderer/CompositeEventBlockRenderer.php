<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Renderer;

use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Renderer\Exception\NoSupportedRendererException;

final class CompositeEventBlockRenderer implements EventBlockRendererInterface
{
    /** @var array<SupportableEventBlockRendererInterface> */
    private array $renderers = [];

    /**
     * @param iterable<object> $renderers
     */
    public function __construct (iterable $renderers)
    {
        foreach ($renderers as $renderer) {
            if (!$renderer instanceof SupportableEventBlockRendererInterface) {
                throw new \InvalidArgumentException(
                    sprintf('Event block renderer must be an instance of "%s".', SupportableEventBlockRendererInterface::class)
                );
            }

            $this->renderers[] = $renderer;
        }
    }

    public function render(EventBlock $block): string
    {
        foreach ($this->renderers as $renderer) {
            if ($renderer->supports($block)) {
                return $renderer->render($block);
            }
        }

        throw new NoSupportedRendererException($block->getEventName(), $block->getName());
    }
}
