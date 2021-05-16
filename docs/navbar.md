# Navbar

[The navbar component](https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/css/navbars) is a responsive and versatile horizontal navigation bar.

## Text
The following example features a brand on the left and some text links on the right.

<p align="center">
    <img src="images/navbar_example_text.jpg">
</p>

</br>

Example:
```php
<?php

declare(strict_types=1);

use Yii\Extension\Tailwind\Asset\TailwindStarterKitAsset;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\View\WebView

/**
 * @var AssetManager $assetManager
 * @var UrlGeneratorInterface $urlGenerator
 * @var UrlMatcherInterface $urlMatcher
 * @var WebView $this
 */

/* Register assets in view */
$assetManager->register([TailwindStarterKitAsset::class]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());

if ($urlMatcher->getCurrentRoute() !== null) {
    $currentPath = $urlMatcher->getCurrentUri()->getPath();
}

NavBar::widget()
    ->backGroundColorTheme(Navbar::BG_BLUGRAY)
    ->brandLink('/')
    ->brandText('BLUEGRAY COLOR')
    ->currentPath($currentPath)
    ->items([
        ['label' => 'discover', 'url' => '#'],
        ['label' => 'profile', 'url' => '#'],
        ['label' => 'setting', 'url' => '#'],
    ])
    ->begin();

NavBar::end();
```

HTML produced is like the following:

```html
<nav id="w0-navbar" class="bg-blueGray-500 flex-wrap flex items-center mb-3 px-2 py-3 relative">
    <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
            <a class="font-bold inline-block leading-relaxed px-4 text-sm uppercase whitespace-nowrap text-white" href="/">BLUEGRAY COLOR</a>
        </div>
        <div>
            <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
            <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
                <li class="nav-item">
                    <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">discover</a>
                </li>
                <li class="nav-item">
                    <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">profile</a>
                </li>
                <li class="nav-item">
                    <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">setting</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
```
