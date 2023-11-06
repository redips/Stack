<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Sylius\TwigEvent\DataCollector\EventsCollector;
use Sylius\TwigEvent\Profiler\Profiler;
use Sylius\TwigEvent\Registry\EventBlocksRegistry;
use Sylius\TwigEvent\Renderer\ComponentEventBlockRenderer;
use Sylius\TwigEvent\Renderer\CompositeEventBlockRenderer;
use Sylius\TwigEvent\Renderer\Debug\EventBlockDebugRenderer;
use Sylius\TwigEvent\Renderer\Debug\EventDebugRenderer;
use Sylius\TwigEvent\Renderer\EventRenderer;
use Sylius\TwigEvent\Renderer\TemplateEventBlockRenderer;
use Sylius\TwigEvent\Renderer\TraceableEventBlockRenderer;
use Sylius\TwigEvent\Renderer\TraceableEventRenderer;
use Sylius\TwigEvent\Twig\EventExtension;

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
        ->decorate('twig_event.event_block_renderer.composite', priority: 4096)
        ->args([
            service('.inner'),
            param('kernel.debug'),
        ])
    ;

    $services->set('twig_event.event_block_renderer.traceable', TraceableEventBlockRenderer::class)
        ->decorate('twig_event.event_block_renderer.debug', priority: 2048)
        ->args([
            service('.inner'),
            service('debug.stopwatch')->ignoreOnInvalid(),
            service('twig_event.profiler'),
            param('kernel.debug'),
        ])
    ;

    $services->set('twig_event.event_block_renderer.template', TemplateEventBlockRenderer::class)
        ->args([
            service('twig'),
        ])
        ->tag('twig_event.event_block_renderer')
    ;

    $services->set('twig_event.event_block_renderer.component', ComponentEventBlockRenderer::class)
        ->args([
            service('ux.twig_component.component_renderer'),
        ])
        ->tag('twig_event.event_block_renderer')
    ;

    $services->set('twig_event.event_renderer', EventRenderer::class)
        ->args([
            service('twig_event.registry.event_blocks'),
            service('twig_event.event_block_renderer.composite'),
        ])
    ;

    $services->set('twig_event.event_renderer.traceable', TraceableEventRenderer::class)
        ->decorate('twig_event.event_renderer', priority: 2048)
        ->args([
            service('.inner'),
            service('twig_event.profiler'),
            service('debug.stopwatch')->ignoreOnInvalid(),
            param('kernel.debug'),
        ])
    ;

    $services->set('twig_event.event_renderer.debug', EventDebugRenderer::class)
        ->decorate('twig_event.event_renderer')
        ->args([
            service('.inner'),
            param('kernel.debug'),
        ])
    ;

    $services->set('twig_event.twig_extension.event', EventExtension::class)
        ->args([
            service('twig_event.event_renderer'),
        ])
        ->tag('twig.extension', ['id' => EventsCollector::class])
    ;

    $services->set('twig_event.data_collector.events', EventsCollector::class)
        ->args([
            service('twig_event.profiler'),
        ])
        ->tag('data_collector')
    ;

    $services->set('twig_event.profiler', Profiler::class)
        ->tag('kernel.reset', ['method' => 'reset'])
    ;
};
