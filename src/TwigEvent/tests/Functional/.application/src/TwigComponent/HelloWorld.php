<?php

declare(strict_types=1);

namespace TestApplication\Sylius\TwigEvent\TwigComponent;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
final class HelloWorld
{
    public string $name;

    #[ExposeInTemplate]
    public function getName(): string
    {
        return $this->name;
    }
}
