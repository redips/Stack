<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('twig_event');

        $rootNode = $treeBuilder->getRootNode();

        $this->addEventsConfiguration($rootNode);

        return $treeBuilder;
    }

    private function addEventsConfiguration(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->fixXmlConfig('event')
            ->children()
                ->arrayNode('events')
                    ->defaultValue([])
                    ->useAttributeAsKey('event_name')
                    ->arrayPrototype()
                        ->fixXmlConfig('block')
                        ->children()
                            ->arrayNode('blocks')
                                ->defaultValue([])
                                ->useAttributeAsKey('block_name')
                                ->arrayPrototype()
                                    ->canBeDisabled()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('template')->end()
                                        ->scalarNode('path')->cannotBeEmpty()->end()
                                        ->arrayNode('context')->addDefaultsIfNotSet()->ignoreExtraKeys(false)->end()
                                        ->integerNode('priority')->defaultValue(0)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
