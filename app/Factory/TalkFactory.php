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

namespace App\Factory;

use App\Entity\Speaker;
use App\Entity\Talk;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;

/**
 * @extends PersistentProxyObjectFactory<Talk>
 */
final class TalkFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Talk::class;
    }

    public function withTitle(string $title): self
    {
        return $this->with(['title' => $title]);
    }

    public function withDescription(string $description): self
    {
        return $this->with(['description' => $description]);
    }

    /** @param Speaker|Proxy<Speaker> $speaker */
    public function withSpeaker(Proxy|Speaker $speaker): self
    {
        return $this->with(['speaker' => $speaker]);
    }

    protected function defaults(): array|callable
    {
        return [
            'speaker' => SpeakerFactory::new(),
            'title' => self::faker()->text(255),
        ];
    }
}
