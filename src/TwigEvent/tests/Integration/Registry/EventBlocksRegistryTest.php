<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Integration\Registry;

use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\DependencyInjection\TwigEventExtension;
use Sylius\TwigEvent\Registry\EventBlocksRegistry;
use Tests\Sylius\TwigEvent\ContainerTestCase;

final class EventBlocksRegistryTest extends ContainerTestCase
{
    public function testItReturnsAllEventBlocks(): void
    {
        $container = $this->getContainer();

        /** @var EventBlocksRegistry $registry */
        $registry = $container->get('twig_event.registry.event_blocks');

        $allEventBlocks = $registry->getAll();

        $this->assertCount(3, $allEventBlocks);
        $this->assertArrayHasKey('some_event', $allEventBlocks);
        $this->assertArrayHasKey('some_event.overriding', $allEventBlocks);
        $this->assertArrayHasKey('app.more_complex.event_name', $allEventBlocks);
    }

    public function testItReturnsEnabledEventBlocksForSingleEvent(): void
    {
        $container = $this->getContainer();

        /** @var EventBlocksRegistry $registry */
        $registry = $container->get('twig_event.registry.event_blocks');

        /** @var array<EventBlock> $enabledEventBlocks */
        $enabledEventBlocks = $registry->getEnabledForEvent('some_event');

        $this->assertCount(2, $enabledEventBlocks);
        $this->assertSame('another_block', $enabledEventBlocks[0]->getName());
        $this->assertSame('some_block', $enabledEventBlocks[1]->getName());
    }

    public function testItReturnsEnabledAndMergedEventBlocksForMultipleEvents(): void
    {
        $container = $this->getContainer();

        /** @var EventBlocksRegistry $registry */
        $registry = $container->get('twig_event.registry.event_blocks');

        /** @var array<EventBlock> $enabledEventBlocks */
        $enabledEventBlocks = $registry->getEnabledForEvent(['some_event', 'some_event.overriding']);

        $this->assertCount(2, $enabledEventBlocks);
        $this->assertSame('another_block', $enabledEventBlocks[0]->getName());
        $this->assertSame('some_block', $enabledEventBlocks[1]->getName());

        $this->assertSame('@SomeBundle/some_template.html.twig', $enabledEventBlocks[1]->getPath());
        $this->assertSame(['some' => 'context'], $enabledEventBlocks[1]->getContext());
        $this->assertSame(16, $enabledEventBlocks[1]->getPriority());

        /** @var array<EventBlock> $enabledEventBlocks */
        $enabledEventBlocks = $registry->getEnabledForEvent(['some_event.overriding', 'some_event']);

        $this->assertCount(2, $enabledEventBlocks);
        $this->assertSame('some_block', $enabledEventBlocks[0]->getName());
        $this->assertSame('another_block', $enabledEventBlocks[1]->getName());

        $this->assertSame('@SomeBundle/overriding_template.html.twig', $enabledEventBlocks[0]->getPath());
        $this->assertSame(['some' => 'override_context'], $enabledEventBlocks[0]->getContext());
        $this->assertSame(64, $enabledEventBlocks[0]->getPriority());
    }

    protected function getMinimalContainerConfiguration(): void
    {
        $this->addExtension(new TwigEventExtension());
        $this->addConfiguration('twig_event', [
            'events' => [
                'some_event' => [
                    'blocks' => [
                        'some_block' => [
                            'type' => 'template',
                            'path' => '@SomeBundle/some_template.html.twig',
                            'context' => ['some' => 'context'],
                            'priority' => 16,
                            'enabled' => true,
                        ],
                        'another_block' => [
                            'type' => 'component',
                            'path' => 'MyComponent',
                            'context' => ['some' => 'context'],
                            'priority' => 32,
                            'enabled' => true,
                        ],
                    ],
                ],
                'some_event.overriding' => [
                    'blocks' => [
                        'some_block' => [
                            'type' => 'template',
                            'path' => '@SomeBundle/overriding_template.html.twig',
                            'context' => ['some' => 'override_context'],
                            'priority' => 64,
                            'enabled' => true,
                        ],
                    ],
                ],
                'app.more_complex.event_name' => [
                    'blocks' => [
                        'yet_another_block' => [
                            'type' => 'template',
                            'path' => '@SomeBundle/another_template.html.twig',
                            'context' => ['some' => 'context'],
                            'enabled' => true,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
