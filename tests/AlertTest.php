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

    /**
     * @link https://v1.tailwindcss.com/components/alerts#banner
     */
    public function testBanner(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(
                ['class' => 'bg-blue-100 border-b border-blue-500 border-t px-4 py-3 text-blue-700', 'role' => 'alert']
            )
            ->buttonAttributes(['class' => 'float-right px-4 py-3'])
            ->message(
                '<p class="font-bold">Informational message</p>' .
                '<p class="text-sm">Some additional text to explain said message.</p>'
            )
            ->messageAttributes(['class' => 'align-middle inline-block mr-8'])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blue-100 border-b border-blue-500 border-t px-4 py-3 text-blue-700" role="alert">
        <span class="align-middle inline-block mr-8"><p class="font-bold">Informational message</p><p class="text-sm">Some additional text to explain said message.</p></span>
        <button type="button" class="float-right px-4 py-3" onclick="closeAlert(event)">&times;</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#left-accent-border
     */
    public function testLeftAccentBorder(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(
                ['class' => 'bg-yellow-100 border-l-2 border-yellow-500 p-4 text-yellow-700', 'role' => 'alert']
            )
            ->buttonAttributes(['class' => 'absolute bottom-0 px-4 py-3 right-0 top-0'])
            ->message('<p><strong>Be Warned</strong></p> <p>Something not ideal might be happening.</p>')
            ->messageAttributes(['class' => 'align-middle inline-block mr-8'])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-yellow-100 border-l-2 border-yellow-500 p-4 text-yellow-700" role="alert">
        <span class="align-middle inline-block mr-8"><p><strong>Be Warned</strong></p> <p>Something not ideal might be happening.</p></span>
        <button type="button" class="absolute bottom-0 px-4 py-3 right-0 top-0" onclick="closeAlert(event)">&times;</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#modern-with-badge
     */
    public function testModernWithBadge(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(
                ['class' => 'bg-gray-900 lg:px-4 py-4 text-center text-white', 'role' => 'alert']
            )
            ->buttonAttributes(['class' => 'bottom-0 px-4 py-3 right-0 top-0'])
            ->containerCssClass('bg-gray-800 p-2 flex items-center leading-none lg:inline-flex lg:rounded-full')
            ->iconContainerAttributes(
                ['class' => ' bg-gray-500 flex font-bold ml-2 mr-3 px-2 py-1 rounded-full text-xs uppercase']
            )
            ->iconCssClass('not-italic')
            ->iconText('🔔 New ')
            ->message('Get the coolest t-shirts from our brand new store')
            ->messageAttributes(['class' => 'flex-auto font-semibold mr-2 text-left'])
            ->template('{icon}{message}{button}')
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-gray-900 lg:px-4 py-4 text-center text-white" role="alert">
        <div class="bg-gray-800 p-2 flex items-center leading-none lg:inline-flex lg:rounded-full">
        <div class=" bg-gray-500 flex font-bold ml-2 mr-3 px-2 py-1 rounded-full text-xs uppercase"><i class="not-italic">🔔 New </i></div>
        <span class="flex-auto font-semibold mr-2 text-left">Get the coolest t-shirts from our brand new store</span>
        <button type="button" class="bottom-0 px-4 py-3 right-0 top-0" onclick="closeAlert(event)">&times;</button>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#solid
     */
    public function testSolid(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(
                ['class' => 'bg-blue-500 flex font-bold items-center px-4 py-3 text-sm text-white', 'role' => 'alert']
            )
            ->buttonAttributes(['class' => 'float-right px-4 py-3'])
            ->iconCssClass('pr-2')
            ->iconText('i')
            ->message('<p>Something happened that you should know about.</p>')
            ->messageAttributes(['class' => 'align-middle flex-grow inline-block mr-8'])
            ->template('{icon}{message}{button}')
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-blue-500 flex font-bold items-center px-4 py-3 text-sm text-white" role="alert">
        <div><i class="pr-2">i</i></div>
        <span class="align-middle flex-grow inline-block mr-8"><p>Something happened that you should know about.</p></span>
        <button type="button" class="float-right px-4 py-3" onclick="closeAlert(event)">&times;</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#traditional
     */
    public function testTraditional(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(['class' => 'bg-gray-600 px-4 py-3 relative rounded text-white'])
            ->buttonAttributes(['class' => 'absolute bottom-0 px-4 py-3 right-0 top-0'])
            ->message('<strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.')
            ->messageAttributes(['class' => 'align-middle inline-block mr-8'])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-gray-600 px-4 py-3 relative rounded text-white">
        <span class="align-middle inline-block mr-8"><strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.</span>
        <button type="button" class="absolute bottom-0 px-4 py-3 right-0 top-0" onclick="closeAlert(event)">&times;</button>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#titled
     */
    public function testTitled(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(['role' => 'alert'])
            ->buttonAttributes(['class' => 'float-right px-4 py-3'])
            ->containerCssClass('bg-red-100 border border-red-400 border-t-0 rounded-b text-red-700')
            ->message('<strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.')
            ->messageAttributes(['class' => 'align-middle inline-block mr-8 px-4 py-3'])
            ->titleAttributes(['class' => 'bg-red-500 font-bold px-4 py-2 rounded-t text-white'])
            ->title('Danger')
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" role="alert">
        <div class="bg-red-100 border border-red-400 border-t-0 rounded-b text-red-700">
        <div class="bg-red-500 font-bold px-4 py-2 rounded-t text-white">Danger</div>
        <span class="align-middle inline-block mr-8 px-4 py-3"><strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.</span>
        <button type="button" class="float-right px-4 py-3" onclick="closeAlert(event)">&times;</button>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    /**
     * @link https://v1.tailwindcss.com/components/alerts#top-accent-border
     */
    public function testTopAccentBorder(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(
                ['class' => 'bg-teal-100 border-t-4 border-teal-500 px-4 py-3 rounded-b shadow-md text-teal-900']
            )
            ->buttonAttributes(['class' => 'float-right px-4 py-3'])
            ->containerCssClass('flex')
            ->iconContainerAttributes(['class' => 'fill-current h-6 mr-4 py-1 text-teal-500 w-6'])
            ->iconCssClass('not-italic')
            ->iconText('🛈')
            ->message(
                '<p class="font-bold">Our privacy policy has changed</p>' .
                '<p class="text-sm">Make sure you know how these changes affect you.</p>'
            )
            ->messageAttributes(['class' => 'align-middle inline-block flex-grow mr-8'])
            ->template('{icon}{message}{button}')
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-teal-100 border-t-4 border-teal-500 px-4 py-3 rounded-b shadow-md text-teal-900">
        <div class="flex">
        <div class="fill-current h-6 mr-4 py-1 text-teal-500 w-6"><i class="not-italic">🛈</i></div>
        <span class="align-middle inline-block flex-grow mr-8"><p class="font-bold">Our privacy policy has changed</p><p class="text-sm">Make sure you know how these changes affect you.</p></span>
        <button type="button" class="float-right px-4 py-3" onclick="closeAlert(event)">&times;</button>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testwithoutButtonClose(): void
    {
        Alert::counter(0);

        $html = Alert::widget()
            ->attributes(['class' => 'bg-gray-600 px-4 py-3 relative rounded text-white'])
            ->message('<strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.')
            ->messageAttributes(['class' => 'align-middle inline-block mr-8'])
            ->withoutButtonClose()
            ->render();
        $expected = <<<'HTML'
        <div id="w0-alert" class="bg-gray-600 px-4 py-3 relative rounded text-white">
        <span class="align-middle inline-block mr-8"><strong class="font-bold">Holy smokes!</strong> Something seriously bad happened.</span>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
