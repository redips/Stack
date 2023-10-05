<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Block;

use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\ComponentEventBlock;

final class ComponentBlockTest extends TestCase
{
    /** @test */
    public function it_returns_blocks_name(): void
    {
        $block = $this->createComponentBlock();

        $this->assertSame('block_name', $block->getName());
    }

    /** @test */
    public function it_returns_blocks_path(): void
    {
        $block = $this->createComponentBlock();

        $this->assertSame('MyComponent', $block->getPath());
    }

    /** @test */
    public function it_returns_blocks_context(): void
    {
        $block = $this->createComponentBlock();

        $this->assertSame(['my' => 'context'], $block->getContext());
    }

    /** @test */
    public function it_returns_blocks_priority(): void
    {
        $block = $this->createComponentBlock();

        $this->assertSame(16, $block->getPriority());
    }

    /** @test */
    public function it_returns_blocks_enabled(): void
    {
        $block = $this->createComponentBlock();

        $this->assertFalse($block->isEnabled());
    }

    private function createComponentBlock(): ComponentEventBlock
    {
        return new ComponentEventBlock(
            'event_name',
            'block_name',
            'MyComponent',
            ['my' => 'context'],
            16,
            false,
        );
    }
}
