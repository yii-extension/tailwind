<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Extension\Tailwind\Dropdown;
use Yii\Extension\Tailwind\Tests\TestSupport\TestTrait;

final class DropdownTest extends TestCase
{
    use TestTrait;

    public function testButtonAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonAttributes(['class' => 'opacity-50'])
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="opacity-50 bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonCcsClass(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonCssClass('py-2 px-2 inline-flex items-center')
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 py-2 px-2 inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonBgColorCssClass(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonBgColorCssClass('bg-pink-500')
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-pink-500 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonIconAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonIconAttributes(['class' => 'font-semibold'])
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="font-semibold pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonIconCssClass(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonIconCssClass('pl-2 fas fa-home')
            ->buttonIconText('')
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 fas fa-home"></i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonIconText(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonIconCssClass('pl-2 font-semibold')
            ->buttonIconText('⌂')
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 font-semibold">⌂</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonTextColorCssClass(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonTextColorCssClass('text-blue-500')
            ->items([['label' => 'Action'], ['label' => 'Another Action']])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-blue-500"><span>Click Me</span><i class="pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Action</a>
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Another Action</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }


    public function testEncodeLabels(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->items([['label' => 'Coffe & Tee', 'encode' => true]])->render();
        $expected = <<<'HTML'
        <div id="w0-dropdown" class="dropdown inline-block relative">
        <button class="bg-gray-600 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Click Me</span><i class="pl-2 not-italic">🠋</i></button>
        <div class="dropdown-content absolute hidden pt-1 w-full">
        <a class="py-2 px-2 block whitespace-nowrap" href="#">Coffe &amp; Tee</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMissingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');
        Dropdown::widget()->items([['items' => [['url' => '#']]]])->render();
    }

    public function testRender(): void
    {
        $this->assertEmpty(Dropdown::widget()->render());
    }

    public function testRenderItems(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonLabel('Products')
            ->buttonBgColorCssClass('bg-blue-500')
            ->items([
                [
                    'label' => 'Computer<i class="fas fa-chevron-right pl-2"></i>',
                    'iconCssClass' => 'fa fa-desktop pr-2',
                    'itemsAttributes' => [
                        'class' => 'dropdown block md:inline-block border-b-2 border-blue-900 md:border-none'
                    ],
                    'items' => [
                        [
                            'label' => 'Components',
                            'items' => [
                                ['label' => 'Cpu',  'iconCssClass' => 'fas fa-microchip pr-2'],
                                ['label' => 'Memory', 'iconCssClass' => 'fas fa-memory pr-2', 'active' => true],
                                ['label' => 'Hdd', 'iconCssClass' => 'fas fa-hdd pr-2', 'disable' => true],
                            ],
                            'itemsAttributes' => ['class' => 'dropdown pl-16 ml-16 md:-mt-10'],
                            'attributes' => ['class' => 'pl-12 ml-16 md:-mt-10'],
                            'iconCssClass' => 'fas fa-chevron-right pl-2',
                            'iconAlign' => 'right',
                        ],
                    ],
                ],
            ])
            ->itemsActiveCssClass('bg-blue-400')
            ->submenuCssClass('block hover:text-blue-500 px-2 py-2 text-blue-900 whitespace-nowrap')
            ->submenuContentCssClass('dropdown-content md:absolute hidden')
            ->submenuItemsCssClass('block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap')
            ->render();
            $expected = <<<'HTML'
            <div id="w0-dropdown" class="dropdown inline-block relative">
            <button class="bg-blue-500 font-semibold py-2 px-4 rounded inline-flex items-center text-white"><span>Products</span><i class="pl-2 not-italic">🠋</i></button>
            <div class="dropdown-content absolute hidden pt-1 w-full">
            <div class="dropdown block md:inline-block border-b-2 border-blue-900 md:border-none">
            <a class="block hover:text-blue-500 px-2 py-2 text-blue-900 whitespace-nowrap" href="#"><i class="fa fa-desktop pr-2"></i>Computer<i class="fas fa-chevron-right pl-2"></i></a>
            <div class="dropdown-content md:absolute hidden">
            <div class="dropdown pl-16 ml-16 md:-mt-10">
            <a class="block hover:text-blue-500 px-2 py-2 text-blue-900 whitespace-nowrap" href="#">Components<i class="fas fa-chevron-right pl-2"></i></a>
            <div class="pl-12 ml-16 md:-mt-10 dropdown-content md:absolute hidden">
            <a class="block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap" href="#"><i class="fas fa-microchip pr-2"></i>Cpu</a>
            <a class="block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap bg-blue-400" href="#"><i class="fas fa-memory pr-2"></i>Memory</a>
            <a class="block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap opacity-50 cursor-not-allowed" href="#"><i class="fas fa-hdd pr-2"></i>Hdd</a>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            HTML;
            $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderNavMultipleLevels(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                [
                    'label' => 'Products',
                    'iconCssClass' => 'fa fa-angle-down pl-2',
                    'iconAlign' => 'right',
                    'itemsAttributes' => [
                        'class' => 'dropdown block md:inline-block border-b-2 border-blue-900 md:border-none'
                    ],
                    'items' => [
                        [
                            'label' => 'Computer',
                            'items' => [
                                ['label' => 'Cpu', 'url' => '#'],
                                ['label' => 'Memory', 'url' => '#'],
                            ],
                            'attributes' => ['class' => 'pl-12 ml-16 md:-mt-10'],
                            'iconCssClass' => 'fa fa-desktop pr-2',
                        ],
                    ],
                ],
            ])
            ->submenuCssClass('block bg-blue-200 hover:text-blue-500 px-3 py-3 text-blue-900 whitespace-nowrap')
            ->submenuContentCssClass('dropdown-content md:absolute hidden')
            ->submenuItemsCssClass('bg-blue-200 block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap')
            ->unClosedByContainer()
            ->render();
            $expected = <<<'HTML'
            <div class="dropdown block md:inline-block border-b-2 border-blue-900 md:border-none">
            <a class="block bg-blue-200 hover:text-blue-500 px-3 py-3 text-blue-900 whitespace-nowrap" href="#">Products<i class="fa fa-angle-down pl-2"></i></a>
            <div class="dropdown-content md:absolute hidden">
            <div class="dropdown">
            <a class="block bg-blue-200 hover:text-blue-500 px-3 py-3 text-blue-900 whitespace-nowrap" href="#"><i class="fa fa-desktop pr-2"></i>Computer</a>
            <div class="pl-12 ml-16 md:-mt-10 dropdown-content md:absolute hidden">
            <a class="bg-blue-200 block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap" href="#">Cpu</a>
            <a class="bg-blue-200 block hover:text-blue-500 py-2 px-4 text-blue-900 whitespace-nowrap" href="#">Memory</a>
            </div>
            </div>
            </div>
            </div>
            HTML;
            $this->assertEqualsWithoutLE($expected, $html);
    }
}
