<?php

namespace MainTests\Sylius\Translations;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @mixin KernelTestCase
 */
trait MarkTestSkippedTrait
{
    private function markTestSkippedIfNecessary(string $locale): void
    {
        if ($this->getContainer()->getParameter('kernel.default_locale') !== $locale) {
            $this->markTestSkipped();
        }
    }
}
