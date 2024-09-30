<?php

declare(strict_types=1);

namespace Functional;

use App\Factory\SpeakerFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

final class SpeakerTest extends WebTestCase
{
    use ResetDatabase;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testBrowsingSpeakers(): void
    {
        SpeakerFactory::new()
            ->withFirstName('Francis')
            ->withLastName('Hilaire')
            ->create()
        ;

        SpeakerFactory::new()
            ->withFirstName('Gregor')
            ->withLastName('Šink')
            ->create()
        ;

        $this->client->request('GET', '/admin/speakers');

        self::assertResponseIsSuccessful();

        // Validate Header
        self::assertSelectorTextContains('h1.page-title', 'Speakers');
        self::assertSelectorExists('a:contains("Create")');

        // Validate Table header
        self::assertSelectorTextContains('.sylius-table-column-firstName', 'First name');
        self::assertSelectorTextContains('.sylius-table-column-lastName', 'Last name');
        self::assertSelectorTextContains('.sylius-table-column-actions', 'Actions');

        // Validate Table data
        self::assertSelectorTextContains('tr.item:first-child', 'Francis');
        self::assertSelectorTextContains('tr.item:first-child', 'Hilaire');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Delete]');

        self::assertSelectorTextContains('tr.item:last-child', 'Gregor');
        self::assertSelectorTextContains('tr.item:last-child', 'Šink');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Delete]');
    }
}
