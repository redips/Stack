<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Functional\Twig;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Sylius\TwigEvent\TwigTemplateTrait;

final class EmptyEventsRenderingTest extends KernelTestCase
{
    use TwigTemplateTrait;

    public function testItRendersSingleEventName(): void
    {
        $renderedTemplate = $this->renderTemplate('single_event_without_blocks.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_empty_event" -->
            
            <!-- END EVENT | event name: "an_empty_event" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }

    public function testItRendersComplexEventName(): void
    {
        $renderedTemplate = $this->renderTemplate('complex_event_without_blocks.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_empty_event, another_empty_event" -->
            
            <!-- END EVENT | event name: "an_empty_event, another_empty_event" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }
}
