<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Block;

use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\TemplateEventBlock;

final class TemplateBlockTest extends TestCase
{
    /** @test */
    public function it_returns_blocks_name(): void
    {
        $block = $this->createTemplateBlock();

        $this->assertSame('block_name', $block->getName());
    }

    /** @test */
    public function it_returns_blocks_path(): void
    {
        $block = $this->createTemplateBlock();

        $this->assertSame('my_template.html.twig', $block->getPath());
    }

    /** @test */
    public function it_returns_blocks_context(): void
    {
        $block = $this->createTemplateBlock();

        $this->assertSame(['my' => 'context'], $block->getContext());
    }

    /** @test */
    public function it_returns_blocks_priority(): void
    {
        $block = $this->createTemplateBlock();

        $this->assertSame(16, $block->getPriority());
    }

    /** @test */
    public function it_returns_blocks_enabled(): void
    {
        $block = $this->createTemplateBlock();

        $this->assertFalse($block->isEnabled());
    }

    private function createTemplateBlock(): TemplateEventBlock
    {
        return new TemplateEventBlock(
            'event_name',
            'block_name',
            'my_template.html.twig',
            ['my' => 'context'],
            16,
            false,
        );
    }
}
