<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([__DIR__ . '/src']);

    $mbConfig->dataToAppend([
        ComposerJsonSection::REQUIRE => [
        ],
        ComposerJsonSection::REQUIRE_DEV => [
            'phpstan/phpstan' => '^1.10',
            'symfony/flex' => '^2',
            'symplify/monorepo-builder' => '11.2.*',
            'vimeo/psalm' => '^5.15',
            'phpstan/phpstan-symfony' => '^1.3'
        ],
        ComposerJsonSection::AUTOLOAD_DEV => [
            'classmap' => ['src/Kernel.php'],
        ],
    ]);
};
