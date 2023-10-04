<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Block;

abstract class Block
{
    /**
     * @param array<string, mixed> $context
     */
    public function __construct (
        private string $name,
        private string $path,
        private array $context,
        private int $priority,
        private bool $enabled,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /** @return array<string, mixed> */
    public function getContext(): array
    {
        return $this->context;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    abstract public function overwriteWith(self $block): self;
}
