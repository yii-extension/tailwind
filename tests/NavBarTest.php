<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use PHPUnit\Framework\TestCase;
use Yii\Extension\Tailwind\NavBar;
use Yii\Extension\Tailwind\Tests\TestSupport\TestTrait;

final class NavBarTest extends TestCase
{
    use TestTrait;

    public function testBrand(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->brand('<span>Mi Proyecto</span>')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w0-navbar">
        <div>
        <span>Mi Proyecto</span><div>
        <button type="button" id="hamburger">
        <svg class="toggle block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg class="toggle hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        </button>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandTextLink(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->brandText('Mi Proyecto')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w0-navbar">
        <div>
        <div>
        <a href="/">Mi Proyecto</a>
        </div>
        <div>
        <button type="button" id="hamburger">
        <svg class="toggle block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg class="toggle hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        </button>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRender(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->attributes(['class' => 'bg-gray-800 flex flex-wrap  items-center justify-between p-5'])
            ->buttonAttributes([
                'class' => 'inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white' .
                'hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white'
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
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w0-navbar" class="bg-gray-800 flex flex-wrap  items-center justify-between p-5">
        <div class="container flex flex-wrap items-center justify-between">
        <div class="flex-shrink-0 flex items-center">
        <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" title="workflow">
        <a class="font-semibold pl-2 text-white" href="https://home.com">Workflow</a>
        </div>
        <div class="flex md:hidden">
        <button type="button" id="hamburger" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-whitehover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
        <svg class="toggle block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg class="toggle hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        </button>
        </div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
