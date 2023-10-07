<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer\Debug;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\Renderer\Debug\EventBlockDebugRenderer;
use Sylius\TwigEvent\Renderer\EventBlockRendererInterface;

final class EventBlockDebugRendererTest extends TestCase
{
    /** @var EventBlockRendererInterface&MockObject */
    private EventBlockRendererInterface $eventBlockRenderer;

    private bool $debug = true;

    protected function setUp(): void
    {
        $this->eventBlockRenderer = $this->createMock(EventBlockRendererInterface::class);
    }

    public function testItDoesNotRenderDebugCommentWhenDebugIsDisabled(): void
    {
        $this->debug = false;

        $someBlock = $this->createMock(EventBlock::class);

        $this->eventBlockRenderer->method('render')->with($someBlock, [])->willReturn('rendered_block');

        $this->assertSame('rendered_block', $this->getRenderer()->render($someBlock));
    }

    public function testItToesNotRenderDebugCommentWhenPassedUnsupportedBlock(): void
    {
        $someBlock = $this->createMock(EventBlock::class);

        $this->eventBlockRenderer->method('render')->with($someBlock, [])->willReturn('rendered_block');

        $renderer = $this->getRenderer();

        $this->assertSame('rendered_block', $renderer->render($someBlock));
    }

    public function testItRendersDebugCommentWhenDebugIsEnabledAndTemplateEventBlockPassed(): void
    {
        $templateBlock = new TemplateEventBlock(
            'event_name',
            'block_name',
            'template.html.twig',
            [],
            0,
            true,
        );

        $this->eventBlockRenderer->method('render')->with($templateBlock, [])->willReturn('rendered_template_block');

        $this->assertSame(
            <<<EXPECTED
            <!-- BEGIN BLOCK | event name: "event_name", block type: "template", block name: "block_name", path: "template.html.twig", priority: 0 -->
            rendered_template_block
            <!-- END BLOCK | event name: "event_name", block type: template, block name: "block_name", path: "template.html.twig", priority: 0 -->
            EXPECTED,
            $this->getRenderer()->render($templateBlock),
        );
    }

    public function testItRendersDebugCommentWhenDebugIsEnabledAndComponentEventBlockPassed(): void
    {
        $componentBlock = new ComponentEventBlock(
            'event_name',
            'block_name',
            'component',
            [],
            0,
            true,
        );

        $this->eventBlockRenderer->method('render')->with($componentBlock, [])->willReturn('rendered_component_block');

        $this->assertSame(
            <<<EXPECTED
            <!-- BEGIN BLOCK | event name: "event_name", block type: "component", block name: "block_name", path: "component", priority: 0 -->
            rendered_component_block
            <!-- END BLOCK | event name: "event_name", block type: component, block name: "block_name", path: "component", priority: 0 -->
            EXPECTED,
            $this->getRenderer()->render($componentBlock),
        );
    }

    private function getRenderer(): EventBlockDebugRenderer
    {
        return new EventBlockDebugRenderer(
            $this->eventBlockRenderer,
            $this->debug,
        );
    }
}
