<?php

declare(strict_types=1);

namespace MainTests\Sylius\Functional;

use App\Factory\SpeakerFactory;
use App\Factory\TalkFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

final class TalkTest extends WebTestCase
{
    use ResetDatabase;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testBrowsingTalks(): void
    {
        TalkFactory::new()
            ->withTitle('Boost Your Sylius Frontend with Hotwire, aka Symfony UX')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Loïc', 'lastName' => 'Caillieux']))
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 10:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 10:45:00'))
            ->create()
        ;

        TalkFactory::new()
            ->withTitle('Admin Panel (R)evolution for Your Symfony Projects')
            ->withSpeakers(SpeakerFactory::findOrCreate(['firstName' => 'Loïc', 'lastName' => 'Frémont']))
            ->withStartingDate(new \DateTimeImmutable('2024-11-13 11:00:00'))
            ->withEndingDate(new \DateTimeImmutable('2024-11-13 11:45:00'))
            ->create()
        ;

        $this->client->request('GET', '/admin/talks');

        self::assertResponseIsSuccessful();

        // Validate Header
        self::assertSelectorTextContains('h1.page-title', 'Talks');
        self::assertSelectorExists('a:contains("Create")');

        // Validate Table header
        self::assertSelectorTextContains('.sylius-table-column-title', 'Title');
        self::assertSelectorTextContains('.sylius-table-column-speakers', 'Speaker');
        self::assertSelectorTextContains('.sylius-table-column-actions', 'Actions');

        // Validate Table data
        self::assertSelectorTextContains('tr.item:first-child', 'Boost Your Sylius Frontend with Hotwire, aka Symfony UX');
        self::assertSelectorTextContains('tr.item:first-child', 'Loïc Caillieux');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Delete]');

        self::assertSelectorTextContains('tr.item:last-child', 'Admin Panel (R)evolution for Your Symfony Projects');
        self::assertSelectorTextContains('tr.item:last-child', 'Loïc Frémont');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Delete]');
    }
}
