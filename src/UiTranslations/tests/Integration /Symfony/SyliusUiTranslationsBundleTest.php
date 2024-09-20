<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Sylius\UiTranslations\Integration\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SyliusUiTranslationsBundleTest extends KernelTestCase
{
    public function testItRegistersUiTranslations(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $translator = $container->get(TranslatorInterface::class);

        $this->assertEquals('Create', $translator->trans('sylius.ui.create'));
        $this->assertEquals('Show', $translator->trans('sylius.ui.show'));
    }
}
