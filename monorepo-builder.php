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
            'symplify/monorepo-builder' => '11.2.*'
        ],
    ]);
};
