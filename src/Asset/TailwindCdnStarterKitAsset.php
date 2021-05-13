<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * @psalm-type CssFile = string|array{0:string,1?:int}&array
 */
final class TailwindCdnStarterKitAsset extends AssetBundle
{
    public bool $cdn = true;

    /** @psalm-var CssFile[] */
    public array $css = [
        [
            'https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.css',
        ],
    ];
}
