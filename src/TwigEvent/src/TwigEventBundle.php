<?php

declare(strict_types=1);

namespace Sylius\TwigEvent;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class TwigEventBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
