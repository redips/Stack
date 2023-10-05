<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\DependencyInjection;


use Sylius\TwigEvent\Block\ComponentEventBlock;
use Sylius\TwigEvent\Block\TemplateEventBlock;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

final class TwigEventExtension extends Extension
{
    private const TEMPLATE_TYPE = 'template';

    private const COMPONENT_TYPE = 'component';

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(dirname(__DIR__, 2) . '/config'));
        $loader->load('services.php');

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
                        $this->registerEventBlock($container, TemplateEventBlock::class, $eventName, $blockName, $block);
                        break;
                    case self::COMPONENT_TYPE:
                        $this->registerEventBlock($container, ComponentEventBlock::class, $eventName, $blockName, $block);
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
    private function registerEventBlock(ContainerBuilder $container, string $class, string $eventName, string $blockName, array $block): void
    {
        $container
            ->register(sprintf('twig_event.%s.block.%s', $eventName, $blockName), $class)
            ->setArguments([
                $eventName,
                $blockName,
                $block['path'],
                $block['context'],
                $block['priority'],
                $block['enabled'],
            ])
            ->addTag('twig_event.block', ['priority' => $block['priority']])
        ;
    }
}
