<?php

declare(strict_types=1);

namespace MainTests\Sylius\Functional;

use App\Factory\ConferenceFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

final class ConferenceTest extends WebTestCase
{
    use ResetDatabase;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testBrowsingConferences(): void
    {
        ConferenceFactory::new()
            ->withName('SyliusCon 2024')
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 09:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 18:00:00'))
            ->create()
        ;

        ConferenceFactory::new()
            ->withName('SyliusCon 2023')
            ->withStartingDate(new \DateTimeImmutable('2023-11-03 09:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2023-11-03 18:00:00'))
            ->create()
        ;

        $this->client->request('GET', '/admin/conferences');

        self::assertResponseIsSuccessful();

        // Validate Header
        self::assertSelectorTextContains('h1.page-title', 'Conferences');
        self::assertSelectorExists('a:contains("Create")');

        // Validate Table header
        self::assertSelectorTextContains('.sylius-table-column-name', 'Name');
        self::assertSelectorTextContains('.sylius-table-column-startsAt', 'Starts at');
        self::assertSelectorTextContains('.sylius-table-column-endsAt', 'Ends at');
        self::assertSelectorTextContains('.sylius-table-column-actions', 'Actions');

        // Validate Table data
        self::assertSelectorTextContains('tr.item:first-child', 'SyliusCon 2024');
        self::assertSelectorTextContains('tr.item:first-child', '2024-11-13 09:00:00');
        self::assertSelectorTextContains('tr.item:first-child', '2024-11-13 18:00:00');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Delete]');

        self::assertSelectorTextContains('tr.item:last-child', 'SyliusCon 2023');
        self::assertSelectorTextContains('tr.item:last-child', '2023-11-03 09:00:00');
        self::assertSelectorTextContains('tr.item:last-child', '2023-11-03 18:00:00');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Delete]');
    }
}
