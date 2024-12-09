<?php

declare(strict_types=1);

namespace MainTests\Sylius\Behat\Context\Ui;

use App\Entity\Book;
use Behat\Behat\Context\Context;
use Behat\Step\When;
use Zenstruck\Foundry\Persistence\Proxy;

final class ManagingBooksContext implements Context
{
    /**
     * @param Proxy<Book> $book
     */
    #[When('/^I want to edit (this book)$/')]
    public function iWantToEditThisBook(Proxy $book): void
    {
        // For now, we are just testing the shared context transform
    }
}
