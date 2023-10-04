<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Block;

final class TemplateBlock extends Block
{
    public function overwriteWith(Block $block): TemplateBlock
    {
        if (!$block instanceof self) {
            throw new \InvalidArgumentException(sprintf('Block "%s" cannot be overwritten with "%s".', self::class, get_class($block)));
        }

        return new self(
            $block->getName(),
            $block->getPath(),
            $block->getContext(),
            $block->getPriority(),
            $block->isEnabled(),
        );
    }
}
