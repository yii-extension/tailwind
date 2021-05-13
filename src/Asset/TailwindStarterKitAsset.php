<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * @psalm-type CssFile = string|array{0:string,1?:int}&array
 */
final class TailwindStarterKitAsset extends AssetBundle
{
    public ?string $basePath = '@assets';

    public ?string $baseUrl = '@assetsUrl';

    public ?string $sourcePath = '@tailwind-starter-kit/storage/assets/css';

    /** @psalm-var CssFile[] */
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
