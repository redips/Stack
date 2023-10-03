<?php

declare(strict_types=1);

namespace Sylius\TwigEvent;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class TwigEventBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
