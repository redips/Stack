<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    public function testItReturnsDefaultConfiguration(): void
    {
        $this->assertProcessedConfigurationEquals(
            [],
            [
                'events' => [],
            ]
        );
    }

    public function testItProhibitsToLeavePathEmpty(): void
    {
        $this->assertPartialConfigurationIsInvalid(
            [
                [
                    'events' => [
                        'some_event' => [
                            'blocks' => [
                                'some_block' => [
                                    'path' => '',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'events.*.blocks.*.path',
            'The path "twig_event.events.some_event.blocks.some_block.path" cannot contain an empty value, but got "".',
        );
    }

    public function testItSetsDefaultBlockTypeToTemplate(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
                [
                    'events' => [
                        'some_event' => [
                            'blocks' => [
                                'some_block' => [
                                    'path' => '@SomeBundle/some_template.html.twig',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'events' => [
                    'some_event' => [
                        'blocks' => [
                            'some_block' => [
                                'type' => 'template',
                                'path' => '@SomeBundle/some_template.html.twig',
                                'context' => [],
                                'priority' => 0,
                                'enabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        );
    }

    public function testItAllowsToAddComponentBlock(): void
    {
        $this->assertProcessedConfigurationEquals(
            [
                [
                    'events' => [
                        'some_event' => [
                            'blocks' => [
                                'some_block' => [
                                    'type' => 'component',
                                    'path' => 'MyComponent',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'events' => [
                    'some_event' => [
                        'blocks' => [
                            'some_block' => [
                                'type' => 'component',
                                'path' => 'MyComponent',
                                'context' => [],
                                'priority' => 0,
                                'enabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        );
    }

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }
}
