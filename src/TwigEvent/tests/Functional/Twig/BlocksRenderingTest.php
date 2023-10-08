<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Functional\Twig;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Sylius\TwigEvent\TwigTemplateTrait;

final class BlocksRenderingTest extends KernelTestCase
{
    use TwigTemplateTrait;

    public function testItRendersASingleEventWithASingleTemplateBlock(): void
    {
        $renderedTemplate = $this->renderTemplate('single_event_with_a_single_template_block.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_event_with_a_template" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <div>
                Hello world from Twig!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_template" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }

    public function testItRendersASingleEventWithASingleComponentBlock(): void
    {
        $renderedTemplate = $this->renderTemplate('single_event_with_a_single_component_block.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_event_with_a_component" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <div>
                Hello world Tester!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_component" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }

    public function testItRendersAComplexEventWithBothTemplateAndComponent(): void
    {
        $renderedTemplate = $this->renderTemplate('complex_event_with_both_template_and_components_blocks.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_event_with_a_template, an_event_with_a_component" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <div>
                Hello world Tester!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <div>
                Hello world from Twig!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_template, an_event_with_a_component" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }

    public function testItRendersAComplexEventWithOverriding(): void
    {
        $renderedTemplate = $this->renderTemplate('complex_event_with_overriding.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_event_with_a_template_but_overriding, an_event_to_be_override" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_template_but_overriding", block type: "template", block name: "hello_world", path: "hi_world.html.twig", priority: 0 -->
            <div>
                Hi world from Twig!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_template_but_overriding", block type: "template", block name: "hello_world", path: "hi_world.html.twig", priority: 0 -->
            <!-- BEGIN BLOCK | event name: "an_event_to_be_override", block type: "template", block name: "goodbye_world", path: "goodbye_world.html.twig", priority: 0 -->
            <div>
                Goodbye world from Twig!
            </div>
            <!-- END BLOCK | event name: "an_event_to_be_override", block type: "template", block name: "goodbye_world", path: "goodbye_world.html.twig", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_template_but_overriding, an_event_to_be_override" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }

    public function testItRendersMultipleEvents(): void
    {
        $renderedTemplate = $this->renderTemplate('multiple_events.html.twig', []);

        self::assertSame(
            <<<OUTPUT
            <!-- BEGIN EVENT | event name: "an_event_with_a_template" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <div>
                Hello world from Twig!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_template", block type: "template", block name: "template_block", path: "hello_world.html.twig", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_template" -->
            <!-- BEGIN EVENT | event name: "an_event_with_a_component" -->
            <!-- BEGIN BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <div>
                Hello world Tester!
            </div>
            <!-- END BLOCK | event name: "an_event_with_a_component", block type: "component", block name: "component_block", path: "HelloWorld", priority: 0 -->
            <!-- END EVENT | event name: "an_event_with_a_component" -->
            OUTPUT,
            trim($renderedTemplate->toString()),
        );
    }
}
