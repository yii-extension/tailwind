<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * @psalm-type JsFile = string|array{0:string,1?:int}&array
 */
final class TailwindJsAsset extends AssetBundle
{
    public ?string $basePath = '@assets';

    public ?string $baseUrl = '@assetsUrl';

    public ?string $sourcePath = '@tailwind-starter-kit/storage/assets/js';

    /** @psalm-var JsFile[] */
    public array $js = [
        'starterkit.js',
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**starterkit.js',
            ),
        ];
    }
}
