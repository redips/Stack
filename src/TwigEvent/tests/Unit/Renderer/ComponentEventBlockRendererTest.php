<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\Renderer\ComponentEventBlockRenderer;
use Sylius\TwigEvent\Renderer\Exception\UnsupportedBlockException;
use Symfony\UX\TwigComponent\ComponentRendererInterface;

final class ComponentEventBlockRendererTest extends TestCase
{
    /** @var ComponentRendererInterface&MockObject */
    private ComponentRendererInterface $componentRenderer;

    protected function setUp(): void
    {
        $this->componentRenderer = $this->createMock(ComponentRendererInterface::class);
    }

    public function testItSupportsOnlyComponentEventBlocks(): void
    {
        $someBlock = $this->createMock(EventBlock::class);
        $templateEventBlock = $this->createMock(TemplateEventBlock::class);
        $componentEventBlock = $this->createMock(ComponentEventBlock::class);

        $renderer = $this->getRenderer();

        self::assertFalse($renderer->supports($someBlock));
        self::assertFalse($renderer->supports($templateEventBlock));
        self::assertTrue($renderer->supports($componentEventBlock));
    }

    public function testItThrowsAnExceptionWhenTryingToRenderUnsupportedBlock(): void
    {
        $someBlock = $this->createMock(EventBlock::class);

        $renderer = $this->getRenderer();

        $this->expectException(UnsupportedBlockException::class);

        $renderer->render($someBlock);
    }

    public function testItRendersComponentEventBlock(): void
    {
        $componentEventBlock = $this->createMock(ComponentEventBlock::class);
        $componentEventBlock->method('getPath')->willReturn('MyComponent');

        $this->componentRenderer->expects(self::once())->method('createAndRender')->with('MyComponent', ['context' => []]);

        $renderer = $this->getRenderer();
        $renderer->render($componentEventBlock);
    }

    public function testItMergesContextsWithPrioritizingTheContextComingFromTwigFunction(): void
    {
        $contextFromTwigFunction = ['some' => 'context'];

        $componentEventBlock = $this->createMock(ComponentEventBlock::class);
        $componentEventBlock->method('getPath')->willReturn('MyComponent');
        $componentEventBlock->method('getContext')->willReturn(['some' => 'other context', 'another' => 'context']);

        $this->componentRenderer->expects(self::once())
            ->method('createAndRender')
            ->with('MyComponent', [
                'some' => 'context', 'another' => 'context', 'context' => ['some' => 'context', 'another' => 'context']
            ])
        ;

        $renderer = $this->getRenderer();
        $renderer->render($componentEventBlock, $contextFromTwigFunction);
    }

    private function getRenderer(): ComponentEventBlockRenderer
    {
        return new ComponentEventBlockRenderer($this->componentRenderer);
    }
}
