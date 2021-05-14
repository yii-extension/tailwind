<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

final class CdnTailwindStarterKitAsset extends AssetBundle
{
    public bool $cdn = true;

    public array $css = [
        [
            'https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.css',
        ],
    ];
}
