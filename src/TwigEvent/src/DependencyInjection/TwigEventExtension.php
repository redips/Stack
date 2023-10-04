<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\DependencyInjection;


use Sylius\TwigEvent\Block\ComponentBlock;
use Sylius\TwigEvent\Block\TemplateBlock;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

final class TwigEventExtension extends Extension
{
    private const TEMPLATE_TYPE = 'template';

    private const COMPONENT_TYPE = 'component';

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration([], $container);
        if ($configuration === null) {
            return;
        }

        $config = $this->processConfiguration($configuration, $configs);

        $this->registerBlocksFromEvents($container, $config['events']);
    }

    /**
     * @param array<string, array{blocks: array<string, array{
     *      type: string,
     *      path: string,
     *      context: array<string, mixed>,
     *      priority: int,
     *      enabled: bool,
     *  }>}> $events
     */
    private function registerBlocksFromEvents(ContainerBuilder $container, array $events): void
    {
        foreach ($events as $eventName => $event) {
            foreach ($event['blocks'] as $blockName => $block) {
                switch ($block['type']) {
                    case self::TEMPLATE_TYPE:
                        $this->registerBlock($container, TemplateBlock::class, $eventName, $blockName, $block);
                        break;
                    case self::COMPONENT_TYPE:
                        $this->registerBlock($container, ComponentBlock::class, $eventName, $blockName, $block);
                        break;
                    default:
                        throw new \InvalidArgumentException(sprintf('Block type "%s" is not supported.', $block['type']));
                }
            }
        }
    }

    /**
     * @param array{
     *     type: string,
     *     path: string,
     *     context: array<string, mixed>,
     *     priority: int,
     *     enabled: bool,
     * } $block
     */
    private function registerBlock(ContainerBuilder $container, string $class, string $eventName, string $blockName, array $block): void
    {
        $blockDefinition = new Definition(
            $class,
            [
                $blockName,
                $block['path'],
                $block['context'],
                $block['priority'],
                $block['enabled'],
            ]
        );
        $blockDefinition->addTag('twig_event.block', ['event' => $eventName, 'priority' => $block['priority']]);

        $container->setDefinition(sprintf('twig_event.%s.block.%s', $eventName, $blockName), $blockDefinition);
    }
}
