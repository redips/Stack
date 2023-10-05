<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Block;

final class ComponentEventBlock extends EventBlock
{
    public function overwriteWith(EventBlock $block): ComponentEventBlock
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
