<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\Renderer\Exception\UnsupportedBlockException;
use Sylius\TwigEvent\Renderer\TemplateEventBlockRenderer;
use Twig\Environment as Twig;

final class TemplateEventBlockRendererTest extends TestCase
{
    /** @var Twig&MockObject */
    private Twig $twig;

    protected function setUp(): void
    {
        $this->twig = $this->createMock(Twig::class);
    }

    public function testItSupportsOnlyTemplateEventBlocks(): void
    {
        $someBlock = $this->createMock(EventBlock::class);
        $templateEventBlock = $this->createMock(TemplateEventBlock::class);
        $componentEventBlock = $this->createMock(ComponentEventBlock::class);

        $renderer = $this->getRenderer();

        self::assertFalse($renderer->supports($someBlock));
        self::assertTrue($renderer->supports($templateEventBlock));
        self::assertFalse($renderer->supports($componentEventBlock));
    }

    public function testItThrowsAnExceptionWhenTryingToRenderUnsupportedBlock(): void
    {
        $someBlock = $this->createMock(EventBlock::class);

        $renderer = $this->getRenderer();

        $this->expectException(UnsupportedBlockException::class);

        $renderer->render($someBlock);
    }

    public function testItRendersTemplateEventBlock(): void
    {
        $templateEventBlock = $this->createMock(TemplateEventBlock::class);
        $templateEventBlock->method('getPath')->willReturn('some/path.html.twig');

        $this->twig->expects(self::once())->method('render')->with('some/path.html.twig', []);

        $renderer = $this->getRenderer();
        $renderer->render($templateEventBlock);
    }

    public function testItMergesContextsWithPrioritizingTheContextComingFromTwigFunction(): void
    {
        $contextFromTwigFunction = ['some' => 'context'];

        $templateEventBlock = $this->createMock(TemplateEventBlock::class);
        $templateEventBlock->method('getPath')->willReturn('some/path.html.twig');
        $templateEventBlock->method('getContext')->willReturn(['some' => 'other context', 'another' => 'context']);

        $this->twig->expects(self::once())
            ->method('render')
            ->with('some/path.html.twig', ['some' => 'context', 'another' => 'context'])
        ;

        $renderer = $this->getRenderer();
        $renderer->render($templateEventBlock, $contextFromTwigFunction);
    }

    private function getRenderer(): TemplateEventBlockRenderer
    {
        return new TemplateEventBlockRenderer($this->twig);
    }
}
