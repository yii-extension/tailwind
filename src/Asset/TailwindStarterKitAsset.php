<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

final class TailwindStarterKitAsset extends AssetBundle
{
    public ?string $basePath = '@assets';

    public ?string $baseUrl = '@assetsUrl';

    public ?string $sourcePath = '@vendor/yii-extension/tailwind-starter-kit/storage/assets';

    public array $css = [
        'css/tailwind-starter-kit.css',
    ];

    public array $js = [
        'js/tailwind-starter-kit.js',
    ];

    public array $depends = [
        PopperAsset::class,
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**/css/tailwind-starter-kit.css',
                '**/js/tailwind-starter-kit.js',
            ),
        ];
    }
}
