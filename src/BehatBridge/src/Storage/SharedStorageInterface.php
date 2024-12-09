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

namespace Sylius\BehatBridge\Storage;

use Sylius\BehatBridge\Exception\InvalidArgumentException;

interface SharedStorageInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function get(string $key): mixed;

    public function has(string $key): bool;

    public function set(string $key, mixed $resource): void;

    public function getLatestResource(): mixed;

    /**
     * @param array<string, mixed> $clipboard
     *
     * @throws InvalidArgumentException
     */
    public function setClipboard(array $clipboard): void;
}
