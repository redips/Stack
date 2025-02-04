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

namespace App\Grid\Filter;

use App\Form\SpeakerAutocompleteType;
use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filter\EntityFilter;
use Sylius\Component\Grid\Filtering\ConfigurableFilterInterface;

final class SpeakerFilter implements ConfigurableFilterInterface
{
    public function __construct(
        private readonly EntityFilter $entityFilter,
    ) {
    }

    public function apply(DataSourceInterface $dataSource, string $name, mixed $data, array $options): void
    {
        $this->entityFilter->apply($dataSource, $name, $data, $options);
    }

    public static function getFormType(): string
    {
        return SpeakerAutocompleteType::class;
    }

    public static function getType(): string
    {
        return self::class;
    }
}
