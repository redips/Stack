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

namespace Sylius\BehatBridge\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\BehatBridge\Formatter\StringInflector;
use Sylius\BehatBridge\Storage\SharedStorageInterface;

final class SharedStorageContext implements Context
{
    public function __construct(
        private readonly SharedStorageInterface $sharedStorage,
    ) {
    }

    /**
     * @Transform /^(it|its|theirs|them)$/
     */
    public function getLatestResource(): mixed
    {
        return $this->sharedStorage->getLatestResource();
    }

    /**
     * @Transform /^(?:this|that|the|my|his|her) ([^"]+)$/
     */
    public function getResource(mixed $resource): mixed
    {
        return $this->sharedStorage->get(StringInflector::nameToCode($resource));
    }
}
