<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Block;

class TemplateEventBlock extends EventBlock
{
    public function getType(): string
    {
        return 'template';
    }

    public function overwriteWith(EventBlock $block): TemplateEventBlock
    {
        if (!$block instanceof self) {
            throw new \InvalidArgumentException(sprintf('Block "%s" cannot be overwritten with "%s".', self::class, get_class($block)));
        }

        return new self(
            $block->getEventName(),
            $block->getName(),
            $block->getPath(),
            $block->getContext(),
            $block->getPriority(),
            $block->isEnabled(),
        );
    }
}
