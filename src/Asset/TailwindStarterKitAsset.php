<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

final class TailwindStarterKitAsset extends AssetBundle
{
    public ?string $basePath = '@assets';

    public ?string $baseUrl = '@assetsUrl';

    public ?string $sourcePath = '@tailwind-starter-kit/storage/assets/css';

    public array $css = [
        'tailwind-starter-kit.css',
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**tailwind-starter-kit.css',
            ),
        ];
    }
}
