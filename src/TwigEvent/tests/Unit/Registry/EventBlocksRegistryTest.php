<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Registry;

use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Registry\EventBlocksRegistry;

final class EventBlocksRegistryTest extends TestCase
{
    public function testItThrowsAnExceptionWhenAnyOfPassedObjectsIsNotAnEventBlock(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Event block must be an instance of "Sylius\TwigEvent\Block\EventBlock".');

        new EventBlocksRegistry([new \stdClass()]);
    }
}
