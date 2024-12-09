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

final class SharedStorage implements SharedStorageInterface
{
    /** @var array<string, mixed> */
    private array $clipboard = [];

    private string|null $latestKey = null;

    public function get(string $key): mixed
    {
        if (!isset($this->clipboard[$key])) {
            throw new InvalidArgumentException(sprintf('There is no current resource for "%s"!', $key));
        }

        return $this->clipboard[$key];
    }

    public function has(string $key): bool
    {
        return isset($this->clipboard[$key]);
    }

    public function set(string $key, mixed $resource): void
    {
        $this->clipboard[$key] = $resource;
        $this->latestKey = $key;
    }

    public function getLatestResource(): mixed
    {
        if (!isset($this->clipboard[$this->latestKey])) {
            throw new InvalidArgumentException('There is no latest resource!');
        }

        return $this->clipboard[$this->latestKey];
    }

    public function setClipboard(array $clipboard): void
    {
        $this->clipboard = $clipboard;
    }
}
