<?php

declare(strict_types=1);

namespace MainTests\Sylius\Functional;

use App\Factory\BookFactory;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Link;
use Zenstruck\Foundry\Test\ResetDatabase;

final class BookTest extends WebTestCase
{
    use ResetDatabase;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testBrowsingBooks(): void
    {
        BookFactory::new()
            ->withTitle('Shinning')
            ->withAuthorName('Stephen King')
            ->create()
        ;

        BookFactory::new()
            ->withTitle('Carrie')
            ->withAuthorName('Stephen King')
            ->create()
        ;

        $this->client->request('GET', '/admin/books');

        self::assertResponseIsSuccessful();

        // Validate Header
        self::assertSelectorTextContains('h1.page-title', 'Books');
        self::assertSelectorExists('a:contains("Create")');

        // Validate Table header
        self::assertSelectorTextContains('.sylius-table-column-title', 'Title');
        self::assertSelectorTextContains('.sylius-table-column-authorName', 'Author Name');
        self::assertSelectorTextContains('.sylius-table-column-actions', 'Actions');

        // Validate Table data
        self::assertSelectorTextContains('tr.item:first-child', 'Carrie');
        self::assertSelectorTextContains('tr.item:first-child', 'Stephen King');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:first-child [data-bs-title=Delete]');

        self::assertSelectorTextContains('tr.item:last-child', 'Shinning');
        self::assertSelectorTextContains('tr.item:last-child', 'Stephen King');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Edit]');
        self::assertSelectorExists('tr.item:last-child [data-bs-title=Delete]');
    }

    public function testSortingBooks(): void
    {
        BookFactory::new()
            ->withTitle('Shinning')
            ->withAuthorName('Stephen King')
            ->create();

        BookFactory::new()
            ->withTitle('Carrie')
            ->withAuthorName('Stephen King')
            ->create();

        $crawler = $this->client->request('GET', '/admin/books');

        self::assertResponseIsSuccessful();

        $link = $crawler->filter('.sylius-table-column-title a')->link();
        $this->client->request('GET', $link->getUri());

        self::assertResponseIsSuccessful();

        // Validate it's sorted by title desc
        self::assertSelectorTextContains('tr.item:first-child', 'Shinning');
        self::assertSelectorTextContains('tr.item:last-child', 'Carrie');
    }

    public function testAddingBookContent(): void
    {
        $this->client->request('GET', '/admin/books/new');

        self::assertResponseIsSuccessful();
    }

    public function testEditingBookContent(): void
    {
        $book = BookFactory::new()
            ->withTitle('Shinning')
            ->withAuthorName('Stephen King')
            ->create();

        $this->client->request('GET', sprintf('/admin/books/%s/edit', $book->getId()));

        self::assertResponseIsSuccessful();
    }

    public function testRemovingBook(): void
    {
        BookFactory::new()
            ->withTitle('Shinning')
            ->withAuthorName('Stephen King')
            ->create();

        $this->client->request('GET', '/admin/books');
        $deleteButton = $this->client->getCrawler()->filter('tr.item:first-child [data-test-confirm-button]');

        $this->client->submit($deleteButton->form());

        self::assertResponseRedirects();

        $this->client->request('GET', '/admin/books');

        // Test flash message
        self::assertSelectorTextContains('[data-test-sylius-flash-message]', 'Book has been successfully deleted.');

        $this->assertCount(0,  BookFactory::all());
    }
}
