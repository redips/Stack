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

namespace Sylius\BehatBridge\Formatter;

final class StringInflector
{
    public static function nameToCode(string $value): string
    {
        return str_replace([' ', '-'], '_', $value);
    }

    private function __construct()
    {
    }
}
