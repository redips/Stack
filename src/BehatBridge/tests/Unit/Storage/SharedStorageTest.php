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

namespace Tests\Sylius\BehatBridge\Unit\Storage;

use PHPUnit\Framework\TestCase;
use Sylius\BehatBridge\Exception\InvalidArgumentException;
use Sylius\BehatBridge\Storage\SharedStorage;
use Sylius\BehatBridge\Storage\SharedStorageInterface;

final class SharedStorageTest extends TestCase
{
    public function testItImplementsStorageInterface(): void
    {
        $this->assertInstanceOf(SharedStorageInterface::class, new SharedStorage());
    }

    public function testItReturnsAnElementFromTheStorageWhenItExists(): void
    {
        $storage = new SharedStorage();
        $storage->set('foo', 'fighters');

        $this->assertSame('fighters', $storage->get('foo'));
    }

    public function testItThrowsAnExceptionWhenTheElementKeyDoesNotExists(): void
    {
        $storage = new SharedStorage();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('There is no current resource for "foo"!');

        $this->assertSame('fighters', $storage->get('foo'));
    }

    public function testItReturnsTheLatestElement(): void
    {
        $storage = new SharedStorage();
        $storage->set('foo', 'bar');
        $storage->set('foo', 'fighters');

        $this->assertSame('fighters', $storage->getLatestResource());
    }

    public function testItThrowsAnExceptionWhenGettingLatestResourceButNoElementsHaveBeenStoredYet(): void
    {
        $storage = new SharedStorage();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('There is no latest resource!');

        $this->assertSame('fighters', $storage->getLatestResource());
    }
}
