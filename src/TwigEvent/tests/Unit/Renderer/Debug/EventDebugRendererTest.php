<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer\Debug;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Renderer\Debug\EventDebugRenderer;
use Sylius\TwigEvent\Renderer\EventRendererInterface;

final class EventDebugRendererTest extends TestCase
{
    /** @var EventRendererInterface&MockObject */
    private EventRendererInterface $eventRenderer;

    private bool $debug = true;

    protected function setUp(): void
    {
        $this->eventRenderer = $this->createMock(EventRendererInterface::class);
    }

    public function testItDoesNotRenderDebugCommentWhenDebugIsDisabled(): void
    {
        $this->debug = false;

        $this->eventRenderer->method('render')->with('event_name', [])->willReturn('rendered_event');

        $this->assertSame('rendered_event', $this->getRenderer()->render('event_name'));
    }

    public function testItRendersDebugCommentWhenDebugIsEnabled(): void
    {
        $this->eventRenderer->method('render')->willReturnMap([
            ['event_name', [], 'rendered_event'],
            [['some_event_name', 'another_event_name'], [], 'rendered_some_and_another_event'],
        ]);

        $this->assertSame(
            <<<EXPECTED
            <!-- BEGIN EVENT | event name: "event_name" -->
            rendered_event
            <!-- END EVENT | event name: "event_name" -->
            EXPECTED,
            $this->getRenderer()->render('event_name'),
        );

        $this->assertSame(
            <<<EXPECTED
            <!-- BEGIN EVENT | event name: "some_event_name, another_event_name" -->
            rendered_some_and_another_event
            <!-- END EVENT | event name: "some_event_name, another_event_name" -->
            EXPECTED,
            $this->getRenderer()->render(['some_event_name', 'another_event_name']),
        );
    }

    private function getRenderer(): EventDebugRenderer
    {
        return new EventDebugRenderer(
            $this->eventRenderer,
            $this->debug,
        );
    }
}
