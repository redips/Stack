<?php

namespace MainTests\Sylius\Behat\Context\Setup;

use App\Factory\BookFactory;
use Behat\Behat\Context\Context;
use Behat\Step\Given;
use Sylius\BehatBridge\Storage\SharedStorageInterface;

final class BookContext implements Context
{
    public function __construct(
        private readonly SharedStorageInterface $sharedStorage,
    ) {
    }

    #[Given('there is a book :title')]
    public function thereIsABook(string $title): void
    {
        $book = BookFactory::new()
            ->withTitle($title)->create()
        ;

        $this->sharedStorage->set('book', $book);
    }
}
