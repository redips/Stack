<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer;

use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Renderer\CompositeEventBlockRenderer;
use Sylius\TwigEvent\Renderer\Exception\NoSupportedRendererException;
use Sylius\TwigEvent\Renderer\SupportableEventBlockRendererInterface;

final class CompositeEventBlockRendererTest extends TestCase
{
    public function testItThrowsExceptionIfNonSupportableEventBlockRendererPassed(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Event block renderer must be an instance of "Sylius\TwigEvent\Renderer\SupportableEventBlockRendererInterface".');

        new CompositeEventBlockRenderer([new \stdClass()]);
    }

    public function testItRendersBlockUsingFirstSupportingRenderer(): void
    {
        $renderer1 = $this->createRenderer('renderer1', false);
        $renderer2 = $this->createRenderer('renderer2');
        $renderer3 = $this->createRenderer('renderer3');

        $compositeRenderer = new CompositeEventBlockRenderer([$renderer1, $renderer2, $renderer3]);

        $this->assertSame('renderer2', $compositeRenderer->render($this->createMock(EventBlock::class)));
    }

    public function testItThrowsAnExceptionIfNoSupportingRendererFound(): void
    {
        $this->expectException(NoSupportedRendererException::class);
        $this->expectExceptionMessage('No supported renderer found for event "some_event" and block "some_block".');

        $renderer1 = $this->createRenderer('renderer1', false);
        $renderer2 = $this->createRenderer('renderer2', false);
        $renderer3 = $this->createRenderer('renderer3', false);

        $block = $this->createMock(EventBlock::class);
        $block->method('getEventName')->willReturn('some_event');
        $block->method('getName')->willReturn('some_block');

        $compositeRenderer = new CompositeEventBlockRenderer([$renderer1, $renderer2, $renderer3]);

        $compositeRenderer->render($block);
    }

    private function createRenderer(string $renderedContent, bool $supports = true): SupportableEventBlockRendererInterface
    {
        $renderer = $this->createMock(SupportableEventBlockRendererInterface::class);
        $renderer->method('render')->willReturn($renderedContent);
        $renderer->method('supports')->willReturn($supports);

        return $renderer;
    }
}
