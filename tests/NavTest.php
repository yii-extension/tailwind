<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Extension\Tailwind\Nav;
use Yii\Extension\Tailwind\NavBar;
use Yii\Extension\Tailwind\Tests\TestSupport\TestTrait;
use Yiisoft\Html\Tag\Img;

final class NavTest extends TestCase
{
    use TestTrait;

    public function testActiveDisable(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => '/site/index',
                    'disable' => true,
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <div>
        <a class="bg-gray-400 text-blue-500 " href="#">Item1</a>
        <a class="opacity-50 pointer-events-none " href="/site/index">Item2</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, trim($html));
    }

    public function testDeepActivateParents(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->activateParents()
            ->attributes(['class' => 'md:flex md:mt-0 md:w-auto text-bold text-right text-black w-full'])
            ->items([
                [
                    'label' => 'Dropdown',
                    'items' => [
                        [
                            'label' => 'Sub-dropdown',
                            'items' => [
                                ['label' => 'Page', 'url' => '#', 'active' => true],
                            ],
                        ],
                    ],
                ],
            ])
            ->itemsCssClass('md:inline-block')
            ->itemsLinkCssClass('block hover:text-blue-500 px-3 py-3 whitespace-nowrap')
            ->submenuCssClass('block hover:text-blue-500 px-3 py-3 whitespace-nowrap')
            ->submenuContentCssClass('dropdown-content hidden md:absolute')
            ->submenuItemsCssClass('block hover:text-blue-500 py-2 px-4 whitespace-nowrap')
            ->render();
        $expected = <<<'HTML'
        <div class="md:flex md:mt-0 md:w-auto text-bold text-right text-black w-full">
        <div class="md:inline-block">
        <div class="dropdown">
        <a class="block hover:text-blue-500 px-3 py-3 whitespace-nowrap" href="#">Dropdown</a>
        <div class="dropdown-content hidden md:absolute" active>
        <div class="dropdown">
        <a class="block hover:text-blue-500 px-3 py-3 whitespace-nowrap" href="#">Sub-dropdown</a>
        <div class="dropdown-content hidden md:absolute" active>
        <a class="block hover:text-blue-500 py-2 px-4 whitespace-nowrap bg-gray-400 text-blue-500" href="#">Page</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, trim($html));
    }

    public function testExplicitActive(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
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
            ->render();
        $expected = <<<'HTML'
        <div>
        <a class href="#">Item1</a>
        <a class href="/site/index">Item2</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, trim($html));
    }

    public function testRenderItemsEncodeLabels(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Encode & Labels',
                    'url' => '#',
                    'encode' => true,
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <div>
        <a class href="#">Encode &amp; Labels</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, trim($html));
    }

    public function testMissingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The label option is required.');
        Nav::widget()->items([['content' => 'Page1']])->render();
    }

    public function testRender(): void
    {
        $this->assertEmpty(Nav::widget()->render());
    }

    /**
     * @link https://tailwindui.com/components/application-ui/navigation/navbars
     */
    public function testRenderNavBarNav(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->attributes(['class' => 'bg-gray-800 flex flex-wrap items-center justify-between p-5'])
            ->buttonAttributes([
                'class' => 'border-2 hover:text-white inline-flex items-center justify-center p-2 text-gray-400'
            ])
            ->buttonContainerAttributes(['class' => 'flex md:hidden'])
            ->brandAttributes(['class' => 'flex-shrink-0 flex items-center'])
            ->brandImageAttributes(['class' => 'block h-8 w-auto', 'title' => 'workflow'])
            ->brandImage('https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg')
            ->brandLink('https://home.com')
            ->containerAttributes(['class' => 'container flex flex-wrap items-center justify-between'])
            ->brandText('Workflow')
            ->brandTextAttributes(['class' => 'font-semibold pl-2 text-white'])
            ->begin();
        $html .= Nav::widget()
            ->attributes(
                ['class' => 'toggle hidden md:flex md:mt-0 md:w-auto text-bold text-right text-white w-full']
            )
            ->currentPath('/computer/memory')
            ->items([
                ['label' => 'Home'],
                [
                    'label' => 'Products',
                    'iconCssClass' => 'fa fa-angle-down pl-2',
                    'iconAlign' => 'right',
                    'items' => [
                        [
                            'label' => 'Computer<i class="fa fa-angle-down pl-2"></i>',
                            'attributes' => ['class' => 'w-full'],
                            'iconCssClass' => 'fa fa-desktop pl-2 pr-2',
                            'items' => [
                                [
                                    'label' => 'Cpu',
                                    'iconCssClass' => 'fas fa-microchip pr-2',
                                    'url' => '/computer/cpu'
                                ],
                                [
                                    'label' => 'Memory',
                                    'iconCssClass' => 'fas fa-memory pr-2',
                                    'url' => '/computer/memory'
                                ],
                                [
                                    'label' => 'Hdd',
                                    'iconCssClass' => 'fas fa-hdd pr-2',
                                    'url' => '/computer/hdd'
                                ],
                            ],
                        ],
                    ],
                ],
                ['label' => 'Pricing', 'disable' => true],
                ['label' => 'Contact'],
            ])
            ->itemsCssClass('border-b-2 md:border-none md:inline-block')
            ->itemsLinkCssClass('block border-b-2 hover:text-blue-500 md:border-none px-3 py-3 whitespace-nowrap')
            ->submenuCssClass('block hover:text-blue-500 px-3 py-3 whitespace-nowrap')
            ->submenuContentCssClass('dropdown-content hidden bg-gray-800 md:absolute')
            ->submenuItemsCssClass('block hover:text-blue-500 py-2 px-4 whitespace-nowrap')
            ->render();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-gray-800 flex flex-wrap items-center justify-between p-5">
        <div class="container flex flex-wrap items-center justify-between">
        <div class="flex-shrink-0 flex items-center">
        <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" title="workflow">
        <a class="font-semibold pl-2 text-white" href="https://home.com">Workflow</a>
        </div>
        <div class="flex md:hidden">
        <button type="button" id="hamburger" class="border-2 hover:text-white inline-flex items-center justify-center p-2 text-gray-400">
        <svg class="toggle block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg class="toggle hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        </button>
        </div>
        <div class="toggle hidden md:flex md:mt-0 md:w-auto text-bold text-right text-white w-full">
        <a class="block border-b-2 hover:text-blue-500 md:border-none px-3 py-3 whitespace-nowrap" href="#">Home</a>
        <div class="border-b-2 md:border-none md:inline-block">
        <div class="dropdown">
        <a class="block hover:text-blue-500 px-3 py-3 whitespace-nowrap" href="#">Products<i class="fa fa-angle-down pl-2"></i></a>
        <div class="dropdown-content hidden bg-gray-800 md:absolute">
        <div class="dropdown">
        <a class="block hover:text-blue-500 px-3 py-3 whitespace-nowrap" href="#"><i class="fa fa-desktop pl-2 pr-2"></i>Computer<i class="fa fa-angle-down pl-2"></i></a>
        <div class="w-full dropdown-content hidden bg-gray-800 md:absolute">
        <a class="block hover:text-blue-500 py-2 px-4 whitespace-nowrap" href="/computer/cpu"><i class="fas fa-microchip pr-2"></i>Cpu</a>
        <a class="block hover:text-blue-500 py-2 px-4 whitespace-nowrap bg-gray-400 text-blue-500" href="/computer/memory"><i class="fas fa-memory pr-2"></i>Memory</a>
        <a class="block hover:text-blue-500 py-2 px-4 whitespace-nowrap" href="/computer/hdd"><i class="fas fa-hdd pr-2"></i>Hdd</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        <a class="opacity-50 pointer-events-none block border-b-2 hover:text-blue-500 md:border-none px-3 py-3 whitespace-nowrap" href="#">Pricing</a>
        <a class="block border-b-2 hover:text-blue-500 md:border-none px-3 py-3 whitespace-nowrap" href="#">Contact</a>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
