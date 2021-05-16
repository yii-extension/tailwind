<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use InvalidArgumentException;
use Yii\Extension\Tailwind\NavBar;
use Yiisoft\Di\Container;
use Yiisoft\Widget\WidgetFactory;

final class NavBarTest extends TestCase
{
    public function testRender(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderBrand(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->brand('<span>Mi Proyecto</span>')->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <span>Mi Proyecto</span>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBackGroundColorTheme(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->backGroundColorTheme(NavBar::BG_AMBER)->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-amber-500 flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBackGroundColorThemeException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "bg-amber-500", "bg-black", "bg-blueGray-500", "bg-emerald-500", ' .
            '"bg-indigo-500", "bg-lightBlue-500", "bg-orange-500", "bg-pink-500", "bg-purple-500", "bg-red-500", ' .
            '"bg-teal-500", "bg-white".'
        );

        $html = NavBar::widget()->backGroundColorTheme('noExist')->begin();
    }

    public function testBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandImage('tests.jpg')
            ->brandImageAttributes(['class' => 'w-6'])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        <img class="w-6" src="tests.jpg" alt="">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandImageText(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandImage('tests.jpg')
            ->brandImageAttributes(['class' => 'w-6'])
            ->brandText('Mi Proyecto')
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        <img class="w-6" src="tests.jpg" alt="">
        <a class="font-bold inline-block leading-relaxed px-4 text-sm uppercase whitespace-nowrap text-white" href="/">Mi Proyecto</a>
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandText(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandText('Mi Proyecto')
            ->brandTextAttributes(['class' => 'testMe'])
            ->brandLink('')
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        <span class="testMe font-bold inline-block leading-relaxed px-4 text-sm uppercase whitespace-nowrap text-white">Mi Proyecto</span></div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandTextLink(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandText('Mi Proyecto')
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        <a class="font-bold inline-block leading-relaxed px-4 text-sm uppercase whitespace-nowrap text-white" href="/">Mi Proyecto</a>
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testContainerAttributes(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->containerAttributes(['class' => 'testMe'])->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="testMe container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testContainerItemsAttributes(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->containerItemsAttributes(['class' => 'testMe'])->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="testMe flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
    public function testItems(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->items([
                ['label' => 'About', 'url' => '/about'],
                ['label' => 'Contact', 'url' => '/contact'],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/about">About</a>
        </li>
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/contact">Contact</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsEmpty(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->items([
                [
                    'label' => 'Page1',
                    'items' => null,
                ],
                [
                    'label' => 'Page4',
                    'items' => [],
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">Page1</a>
        </li>
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">Page4</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsEncodeLabels(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->items([
                [
                    'label' => 'a & b',
                    'encode' => false,
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">a & b</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        $html = NavBar::widget()
            ->items([
                [
                    'label' => 'a & b',
                    'encode' => true,
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w1-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w1-items-navbar&apos;)">☰</button>
        </div>
        <div id="w1-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">a &amp; b</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsIcon(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandImage('yii-logo.jpg')
            ->brandText('My Project')
            ->items([
                [
                    'label' => 'Setting Account',
                    'url' => '/setting/account',
                    'icon' => 'fas fa-user-cog px-2',
                    'iconOptions' => ['class' => 'icon'],
                ],
                [
                    'label' => 'Profile',
                    'url' => '/profile',
                    'icon' => 'fas fa-users px-2',
                    'iconOptions' => ['class' => 'icon'],
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        <img src="yii-logo.jpg" alt="">
        <a class="font-bold inline-block leading-relaxed px-4 text-sm uppercase whitespace-nowrap text-white" href="/">My Project</a>
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/setting/account">
        <span><i class="fas fa-user-cog px-2"></i></span><span>Setting Account</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/profile">
        <span><i class="fas fa-users px-2"></i></span><span>Profile</span>
        </a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsExplicitActive(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withoutActivateItems()
            ->items([
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => '/site/index',
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">Item1</a>
        </li>
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/site/index">Item2</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsImplicitActive(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->currentPath('/site/index')
            ->items([
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => '/site/index',
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="bg-gray-900 flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">Item1</a>
        </li>
        <li class="nav-item">
        <a class="bg-gray-900 flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="/site/index">Item2</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsLabelException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');

        NavBar::widget()
            ->items([
                [
                    'items' => [
                        ['url' => '#'],
                        '-',
                        ['label' => 'Level 2', 'url' => '#', 'visible' => true],
                    ],
                ],
            ])
            ->begin();
    }

    public function testItemLinkDisabled(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->items([
                [
                    'label' => 'Link disable',
                    'url' => '#',
                    'disabled' => true,
                ],
            ])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#" style="opacity:.75; pointer-events:none;">Link disable</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsWithoutUrl(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->items([['label' => 'Page1']])->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl text-white" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        <li class="nav-item">
        <a class="flex font-bold hover:opacity-75 items-center leading-snug px-3 py-2 text-xs uppercase text-white" href="#">Page1</a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleAttributes(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->toggleAttributes(['class' => 'text-white'])->begin();
        $html .= NavBar::end();


        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-black flex-wrap flex items-center mb-3 px-2 py-3 relative">
        <div class="container flex-wrap flex items-center justify-between mx-auto px-4">
        <div class="flex justify-between lg:justify-start lg:static lg:w-auto px-4 relative">
        </div>
        <div>
        <button type="button" class="text-white block border-solid border-transparent border cursor-pointer focus:outline-none leading-none lg:hidden outline-none px-3 py-1 rounded bg-transparent text-xl" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar" class="flex-grow hidden items-center lg:flex">
        <ul class="flex-col flex lg:flex-row lg:ml-auto list-none">
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testWithoutDefaults(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->withoutLoadDefaultTheme()->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w0-navbar">
        <div>
        <div>
        </div>
        <div>
        <button type="button" onclick="toggleNavbar(&apos;w0-items-navbar&apos;)">☰</button>
        </div>
        <div id="w0-items-navbar">
        <ul>
        </ul>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
