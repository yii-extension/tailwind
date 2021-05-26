<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use InvalidArgumentException;
use Yii\Extension\Tailwind\Dropdown;

final class DropdownTest extends TestCase
{
    public function testButtonAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->buttonAttributes(['class' => 'testMe'])->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="testMe" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBackgroundColorTheme(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->backgroundColorTheme(Dropdown::BG_RED)->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-red-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBackgroundColorThemeException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "bg-amber-500", "bg-black", "bg-blueGray-500", "bg-emerald-500", ' .
            '"bg-indigo-500", "bg-lightBlue-500", "bg-orange-500", "bg-pink-500", "bg-purple-500", "bg-red-500", ' .
            '"bg-teal-500", "bg-transparent", "bg-white".'
        );

        $html =  Dropdown::widget()->backgroundColorTheme('noExist')->render();
    }

    public function testButtonIcon(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->buttonIcon('&#8593;')->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8593;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLabel(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->buttonLabel('testMe')->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>testMe</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLabelAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->buttonLabelAttributes(['class' => 'testMe'])->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span class="testMe">Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDividerClass(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->dividerAttributes(['class' => 'dropdown-divider'])->items(['-'])->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <div class="dropdown-divider"></div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItems(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>San petesburgo</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Novosibirsk</span></a>
        <div class="border-blueGray-800 border-solid border-t-0 border h-0 my-2 opacity-25"></div>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsActive(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                ['label' => 'San petesburgo', 'url' => '#', 'active' => true],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap bg-gray-900 text-white" href="#"><span>San petesburgo</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Novosibirsk</span></a>
        <div class="border-blueGray-800 border-solid border-t-0 border h-0 my-2 opacity-25"></div>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->itemsContainerAttributes(['class' => 'testMe'])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="testMe">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsIcon(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                ['label' => 'Ekaterinburgo', 'url' => '#', 'icon' => 'fas fa-home'],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#">
        <span><i class="fas fa-home"></i></span>
        <span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsIconAttribute(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                [
                    'label' => 'Ekaterinburgo',
                    'url' => '#',
                    'icon' => 'fas fa-home',
                    'iconAttributes' => ['class' => 'testMe']
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#">
        <span class="testMe"><i class="fas fa-home"></i></span>
        <span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsImplicitActive(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
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
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap bg-gray-900 text-white" href=""><span>Item1</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap bg-gray-900 text-white" href="/site/index"><span>Item2</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsLabelEncode(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                ['label' => 'San petesburgo & Novosibirs', 'url' => '#', 'encode' => true],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>San petesburgo &amp;amp; Novosibirs</span></a>
        <div class="border-blueGray-800 border-solid border-t-0 border h-0 my-2 opacity-25"></div>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsLabelException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');

        Dropdown::widget()
            ->items([
                [
                    'items' => [
                        ['url' => '#'],
                        '-',
                        ['label' => 'Level 2', 'url' => '#', 'visible' => true],
                    ],
                ],
            ])
            ->render();
    }

    public function testItemsSubDropdown(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->items([
                [
                    'label' => 'Chile',
                    'items' => [
                        ['label' => 'Chillan', 'url' => '#'],
                        ['label' => 'Santiago', 'url' => '#'],
                    ],
                ],
                '-',
                [
                    'label' => 'Rusia',
                    'items' => [
                        ['label' => 'Novosibirsk', 'url' => '#'],
                        ['label' => 'Ekaterinburgo', 'url' => '#'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <div id="w1-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-transparent text-black duration-150 ease-linear focus:outline-none hover:shadow-lg mb-1 mr-1 outline-none py-3 rounded shadow text-sm transition-all" onclick="openDropdown(event, &apos;w1-dropdown-items&apos;)"><span>Chile</span><i class="pl-2">&#8594;</i></button>
        <div id="w1-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Chillan</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Santiago</span></a>
        </div>
        </div>
        </div>
        </div>
        <div class="border-blueGray-800 border-solid border-t-0 border h-0 my-2 opacity-25"></div>
        <div id="w2-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-transparent text-black duration-150 ease-linear focus:outline-none hover:shadow-lg mb-1 mr-1 outline-none py-3 rounded shadow text-sm transition-all" onclick="openDropdown(event, &apos;w2-dropdown-items&apos;)"><span>Rusia</span><i class="pl-2">&#8594;</i></button>
        <div id="w2-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Novosibirsk</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Ekaterinburgo</span></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsSubDropdownAttributes(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonSubDropdownAttributes(['class' => 'testMe'])
            ->items([
                [
                    'label' => 'Chile',
                    'items' => [
                        ['label' => 'Chillan', 'url' => '#'],
                        ['label' => 'Santiago', 'url' => '#'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <div id="w1-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="testMe" onclick="openDropdown(event, &apos;w1-dropdown-items&apos;)"><span>Chile</span><i class="pl-2">&#8594;</i></button>
        <div id="w1-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Chillan</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Santiago</span></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsSubDropdownBackgroundColor(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonSubDropdownBackgroundColor(Dropdown::BG_RED)
            ->items([
                [
                    'label' => 'Chile',
                    'items' => [
                        ['label' => 'Chillan', 'url' => '#'],
                        ['label' => 'Santiago', 'url' => '#'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <div id="w1-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-red-500 text-black duration-150 ease-linear focus:outline-none hover:shadow-lg mb-1 mr-1 outline-none py-3 rounded shadow text-sm transition-all" onclick="openDropdown(event, &apos;w1-dropdown-items&apos;)"><span>Chile</span><i class="pl-2">&#8594;</i></button>
        <div id="w1-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Chillan</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Santiago</span></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testItemsSubDropdownBackgroundColorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "bg-amber-500", "bg-black", "bg-blueGray-500", "bg-emerald-500", ' .
            '"bg-indigo-500", "bg-lightBlue-500", "bg-orange-500", "bg-pink-500", "bg-purple-500", "bg-red-500", ' .
            '"bg-teal-500", "bg-transparent", "bg-white".'
        );

        $html =  Dropdown::widget()->buttonSubDropdownBackgroundColor('noExist')->render();
    }

    public function testItemsSubDropdownTextColor(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonSubDropdownTextColor('text-red-500')
            ->items([
                [
                    'label' => 'Chile',
                    'items' => [
                        ['label' => 'Chillan', 'url' => '#'],
                        ['label' => 'Santiago', 'url' => '#'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <div id="w1-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-transparent text-red-500 duration-150 ease-linear focus:outline-none hover:shadow-lg mb-1 mr-1 outline-none py-3 rounded shadow text-sm transition-all" onclick="openDropdown(event, &apos;w1-dropdown-items&apos;)"><span>Chile</span><i class="pl-2">&#8594;</i></button>
        <div id="w1-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Chillan</span></a>
        <a class="block font-normal px-4 py-2 text-sm w-full whitespace-nowrap text-blueGray-700 bg-transparent" href="#"><span>Santiago</span></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRender(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-white duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderWithoutLoadDefaultTheme(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->withoutLoadDefaultTheme()->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown">
        <div>
        <div>
        <button onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testTextColorTheme(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()->textColorTheme('text-black')->render();

        $expected = <<<'HTML'
        <div id="w0-dropdown" class="flex flex-wrap">
        <div class="md:w-4/12 px-4 sm:w-6/12 w-full">
        <div class="align-middle inline-flex relative w-full">
        <button class="bg-blueGray-500 text-black duration-150 ease-linear focus:outline-none font-bold hover:shadow-lg mb-1 mr-1 outline-none px-6 py-3 rounded shadow text-sm transition-all uppercase" onclick="openDropdown(event, &apos;w0-dropdown-items&apos;)"><span>Dropdown</span><i class="pl-2">&#8595;</i></button>
        <div id="w0-dropdown-items" class="float-left hidden bg-white list-none mt-1 py-2 rounded shadow-lg text-base text-left z-50" style="min-width:12rem">
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
