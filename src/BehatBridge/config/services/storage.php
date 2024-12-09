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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Sylius\BehatBridge\Storage\SharedStorage;
use Sylius\BehatBridge\Storage\SharedStorageInterface;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services->set('sylius_behat_bridge.storage.shared', SharedStorage::class);
    $services->alias(SharedStorageInterface::class, 'sylius_behat_bridge.storage.shared');
};
