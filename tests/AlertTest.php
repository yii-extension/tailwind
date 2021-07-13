<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Extension\Tailwind\Alert;
use Yii\Extension\Tailwind\Tests\TestSupport\TestTrait;

final class AlertTest extends TestCase
{
    use TestTrait;

    public function testButtonAttributes(): void
    {
        Alert::counter(0);

        $html = Alert::widget()->buttonAttributes(['class' => 'testMe'])->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blueGray-500 border-0 mb-4 px-6 py-4 relative rounded text-white">
        <button type="button" class="testMe" onclick="closeAlert(event)">x</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRender(): void
    {
        Alert::counter(0);

        $html = Alert::widget()->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blueGray-500 border-0 mb-4 px-6 py-4 relative rounded text-white">
        <button type="button" class="absolute bg-transparent focus:outline-none font-semibold leading-none mr-6 mt-4 outline-none right-0 text-2xl top-0" onclick="closeAlert(event)">x</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderIconMessage(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->icon('fas fa-bell')
            ->message('<b>BlueGray!</b> This is a pink alert - check it out!')
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blueGray-500 border-0 mb-4 px-6 py-4 relative rounded text-white">
        <span class="align-middle inline-block mr-5 text-xl"><i class="fas fa-bell"></i></span>
        <span class="align-middle inline-block mr-8 text-white"><b>BlueGray!</b> This is a pink alert - check it out!</span>
        <button type="button" class="absolute bg-transparent focus:outline-none font-semibold leading-none mr-6 mt-4 outline-none right-0 text-2xl top-0" onclick="closeAlert(event)">x</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderMessage(): void
    {
        Alert::counter(0);

        $html = Alert::widget()->message('<b>BlueGray!</b> This is a pink alert - check it out!')->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blueGray-500 border-0 mb-4 px-6 py-4 relative rounded text-white">
        <span class="align-middle inline-block mr-8 text-white"><b>BlueGray!</b> This is a pink alert - check it out!</span>
        <button type="button" class="absolute bg-transparent focus:outline-none font-semibold leading-none mr-6 mt-4 outline-none right-0 text-2xl top-0" onclick="closeAlert(event)">x</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRenderWithoutLoadDefaultTheme(): void
    {
        Alert::counter(0);

        $html = Alert::widget()->withoutLoadDefaultTheme()->render();
        $expected = <<<'HTML'
        <div id="w0-alert">
        <button type="button" onclick="closeAlert(event)">x</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testWithoutButton(): void
    {
        Alert::counter(0);

        $html = Alert::widget()->withoutButton()->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blueGray-500 border-0 mb-4 px-6 py-4 relative rounded text-white">
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
