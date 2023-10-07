<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Sylius\TwigEvent\Registry\EventBlocksRegistry;
use Sylius\TwigEvent\Renderer\CompositeEventBlockRenderer;
use Sylius\TwigEvent\Renderer\Debug\EventBlockDebugRenderer;
use Sylius\TwigEvent\Renderer\Debug\EventDebugRenderer;
use Sylius\TwigEvent\Renderer\EventRenderer;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services->set('twig_event.registry.event_blocks', EventBlocksRegistry::class)
        ->args([
            tagged_iterator('twig_event.block'),
        ])
    ;

    $services->set('twig_event.event_block_renderer.composite', CompositeEventBlockRenderer::class)
        ->args([
            tagged_iterator('twig_event.event_block_renderer'),
        ])
    ;

    $services->set('twig_event.event_block_renderer.debug', EventBlockDebugRenderer::class)
        ->decorate('twig_event.event_block_renderer.composite')
        ->args([
            service('.inner'),
            param('kernel.debug'),
        ])
    ;

    $services->set('twig_event.event_renderer', EventRenderer::class)
        ->args([
            service('twig_event.registry.event_blocks'),
            service('twig_event.event_block_renderer.composite'),
        ])
    ;

    $services->set('twig_event.event_renderer.debug', EventDebugRenderer::class)
        ->decorate('twig_event.event_renderer')
        ->args([
            service('.inner'),
            param('kernel.debug'),
        ])
    ;
};
