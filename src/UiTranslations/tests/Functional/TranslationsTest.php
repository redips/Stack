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

namespace Tests\Sylius\UiTranslations\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TranslationsTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testTranslations(): void
    {
        $this->client->request('GET', '/translations');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('[data-test-create]', 'Create');
        self::assertSelectorTextContains('[data-test-show]', 'Show');
    }
}
