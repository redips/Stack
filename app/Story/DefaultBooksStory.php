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

namespace App\Story;

use App\Factory\BookFactory;
use Zenstruck\Foundry\Story;

final class DefaultBooksStory extends Story
{
    public function build(): void
    {
        BookFactory::new()
            ->withTitle('1984')
            ->withAuthorName('George Orwell')
            ->create()
        ;

        BookFactory::new()
            ->withTitle('Lord of the Flies')
            ->withAuthorName('William Golding')
            ->create()
        ;

        BookFactory::createMany(20);
    }
}
