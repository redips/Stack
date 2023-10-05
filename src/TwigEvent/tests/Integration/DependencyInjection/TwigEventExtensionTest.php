<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Integration\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Sylius\TwigEvent\DependencyInjection\TwigEventExtension;

final class TwigEventExtensionTest extends AbstractExtensionTestCase
{
    public function testItRegistersBlocksAsServices(): void
    {
        $this->load([
            'events' => [
                'some_event' => [
                    'blocks' => [
                        'some_block' => [
                            'type' => 'template',
                            'path' => '@SomeBundle/some_template.html.twig',
                            'context' => ['some' => 'context'],
                            'priority' => 16,
                            'enabled' => false,
                        ],
                        'another_block' => [
                            'type' => 'component',
                            'path' => 'MyComponent',
                            'context' => ['some' => 'context'],
                            'priority' => 16,
                            'enabled' => false,
                        ],
                    ],
                ],
                'app.more_complex.event_name' => [
                    'blocks' => [
                        'yet_another_block' => [
                            'type' => 'template',
                            'path' => '@SomeBundle/another_template.html.twig',
                            'context' => ['some' => 'context'],
                            'enabled' => false,
                        ],
                    ],
                ]
            ],
        ]);

        $this->assertContainerBuilderHasService('twig_event.some_event.block.some_block', TemplateEventBlock::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'twig_event.some_event.block.some_block',
            'twig_event.block',
            ['priority' => 16],
        );

        $this->assertContainerBuilderHasService('twig_event.some_event.block.another_block', ComponentEventBlock::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'twig_event.some_event.block.another_block',
            'twig_event.block',
            ['priority' => 16],
        );

        $this->assertContainerBuilderHasService('twig_event.app.more_complex.event_name.block.yet_another_block', TemplateEventBlock::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'twig_event.app.more_complex.event_name.block.yet_another_block',
            'twig_event.block',
            ['priority' => 0],
        );
    }

    public function testItThrowsAnExceptionWhenNotSupportedBlockTypeIsUsed(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Block type "not_supported" is not supported.');

        $this->load([
            'events' => [
                'some_event' => [
                    'blocks' => [
                        'some_block' => [
                            'type' => 'not_supported',
                            'path' => '@SomeBundle/some_template.html.twig',
                        ],
                    ],
                ],
            ],
        ]);
    }

    protected function getContainerExtensions(): array
    {
        return [
            new TwigEventExtension(),
        ];
    }
}
