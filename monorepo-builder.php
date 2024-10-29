<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Config\MBConfig;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__ . '/src']);

    $mbConfig->dataToAppend([
        ComposerJsonSection::REQUIRE => [
        ],
        ComposerJsonSection::REQUIRE_DEV => [
            'phpstan/phpstan' => '^1.10',
            'symfony/debug-bundle' => '^6.4 || ^7.0',
            'symfony/flex' => '^2.4',
            'symplify/monorepo-builder' => '11.2.*',
            'phpstan/phpstan-symfony' => '^1.3'
        ],
        ComposerJsonSection::AUTOLOAD_DEV => [
            'classmap' => ['src/Kernel.php'],
        ],
    ]);

    $services = $mbConfig->services();
    $services->set(SetCurrentMutualDependenciesReleaseWorker::class);
    $services->set(TagVersionReleaseWorker::class);
    $services->set(PushTagReleaseWorker::class);
};
