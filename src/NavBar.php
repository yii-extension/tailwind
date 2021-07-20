<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Img;

/**
 * This the upper navigation of your website. You can add in it links, icons, links with icons, search bars and a brand
 * text.
 *
 * @link https://tailwindui.com/components/application-ui/navigation/navbars
 */
final class NavBar extends Widget
{
    private string $brand = '';
    private array $brandAttributes = [];
    private string $brandImage = '';
    private array $brandImageAttributes = [];
    private string $brandLink = '/';
    private string $brandText = '';
    private array $brandTextAttributes = [];
    private array $buttonAttributes = [];
    private array $buttonContainerAttributes = [];
    private array $containerAttributes = [];
    private array $iconSvgAttributes = [
        'square' => [
            'svg' => [
                'class' => 'toggle block h-6 w-6',
                'xmlns' => 'http://www.w3.org/2000/svg',
                'fill' => 'none',
                'viewBox' => '0 0 24 24',
                'stroke' => 'currentColor',
                'aria-hidden' => 'true',
            ],
            'path' => [
                'stroke-linecap' => 'round',
                'stroke-linejoin' => 'round',
                'stroke-width' => '2',
                'd' => 'M4 6h16M4 12h16M4 18h16',
            ],
        ],
        'close' => [
            'svg' => [
                'class' => 'toggle hidden h-6 w-6',
                'xmlns' => 'http://www.w3.org/2000/svg',
                'fill' => 'none',
                'viewBox' => '0 0 24 24',
                'stroke' => 'currentColor',
                'aria-hidden' => 'true',
            ],
            'path' => [
                'stroke-linecap' => 'round',
                'stroke-linejoin' => 'round',
                'stroke-width' => '2',
                'd' => 'M6 18L18 6M6 6l12 12',
            ],
        ],
    ];

    public function begin(): string
    {
        parent::begin();
        $new = clone $this;
        return $new->navBar($new);
    }

    protected function run(): string
    {
        return Html::closeTag('div') . PHP_EOL . Html::closeTag('nav');
    }

    /**
     * Set render brand custom, {@see brandText} and {@see brandImage} are not generated.
     *
     * @param string $value
     *
     * @return static
     */
    public function brand(string $value): self
    {
        $new = clone $this;
        $new->brand = $value;
        return $new;
    }

    /**
     * The HTML attributes for the brand. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return static
     */
    public function brandAttributes(array $value): self
    {
        $new = clone $this;
        $new->brandAttributes = $value;
        return $new;
    }

    /**
     * Src of the brand image or empty if it's not used. Note that this param will override `$this->brandText` param.
     *
     * @param string $value
     *
     * @return static
     */
    public function brandImage(string $value): self
    {
        $new = clone $this;
        $new->brandImage = $value;
        return $new;
    }

    /**
     * The HTML attributes for the brand image. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return static
     */
    public function brandImageAttributes(array $value): self
    {
        $new = clone $this;
        $new->brandImageAttributes = $value;

        return $new;
    }

    /**
     * The LINK for the brand's hyperlink tag and will be used for the "href" attribute of the brand link. Default value
     * is "/". You may set it to empty string if you want no link at all.
     *
     * @param string $value
     *
     * @return static
     */
    public function brandLink(string $value): self
    {
        $new = clone $this;
        $new->brandLink = $value;
        return $new;
    }

    /**
     * The text of the brand or empty if it's not used. Note that this is not HTML-encoded.
     *
     * @param string $value
     *
     * @return static
     */
    public function brandText(string $value): self
    {
        $new = clone $this;
        $new->brandText = $value;
        return $new;
    }

    /**
     * The HTML attributes for the brand text. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return static
     */
    public function brandTextAttributes(array $value): self
    {
        $new = clone $this;
        $new->brandTextAttributes = $value;
        return $new;
    }

        /**
     * The HTML attributes of the navbar toggler button.
     *
     * @param array $value
     *
     * @return static
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonAttributes = $value;
        return $new;
    }

    /**
     * The HTML attributes of the navbar container button.
     *
     * @param array $value
     *
     * @return static
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonContainerAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonContainerAttributes = $value;
        return $new;
    }

    /**
     * The HTML attributes for the container navbar. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return static
     */
    public function containerAttributes(array $value): self
    {
        $new = clone $this;
        $new->containerAttributes = $value;

        return $new;
    }

    private function navBar(self $new): string
    {
        $attributes = $new->getAttributes();

        if (!isset($attributes['id'])) {
            $attributes['id'] = "{$new->getId()}-navbar";
        }

        return Html::openTag('nav', $attributes) . PHP_EOL . $new->navBarContainer($new) . PHP_EOL;
    }

    private function navBarBrand(self $new): string
    {
        $brand = '';

        if ($new->brand !== '') {
            return $new->brand;
        }

        if ($new->brandImage !== '') {
            $brand .= Img::tag()->attributes($new->brandImageAttributes)->url($new->brandImage)->render();
        }

        if ($new->brandImage !== '' && $new->brandText !== '') {
            $brand .= PHP_EOL . A::tag()
                ->attributes($new->brandTextAttributes)
                ->content($new->brandText)
                ->url($new->brandLink)
                ->render() . PHP_EOL;
        }

        if ($new->brandText !== '' && $new->brandImage === '') {
            $brand .= A::tag()
                ->attributes($new->brandTextAttributes)
                ->content($new->brandText)
                ->url($new->brandLink)
                ->render() . PHP_EOL;
        }

        return Div::tag()
            ->attributes($new->brandAttributes)
            ->content(PHP_EOL . trim($brand) . PHP_EOL)
            ->encode(false)
            ->render() . PHP_EOL;
    }

    private function navBarContainer(self $new): string
    {
        return
            Html::openTag('div', $new->containerAttributes) . PHP_EOL .
            $new->navBarBrand($new) .
            $new->navBarButtonToggle($new);
    }

    private function navBarButtonToggle(self $new): string
    {
        if (!isset($new->buttonAttributes['id'])) {
            $new->buttonAttributes['id'] = "hamburger";
        }

        $button = Button::tag()
            ->attributes($new->buttonAttributes)
            ->content(PHP_EOL . $new->navBarButtonIcon($new))
            ->encode(false)
            ->type('button')
            ->render();

        return Div::tag()
            ->attributes($new->buttonContainerAttributes)
            ->content(PHP_EOL . $button . PHP_EOL)
            ->encode(false)
            ->render();
    }

    private function navbarButtonIcon(self $new): string
    {
        $html = '';

        /** @var array $iconSvgAttribute */
        foreach ($new->iconSvgAttributes as $iconSvgAttribute) {
            /** @var array $path */
            $path = $iconSvgAttribute['path'] ?? [];

            /** @var array $svg */
            $svg = $iconSvgAttribute['svg'] ?? [];

            $path = CustomTag::name('path')->attributes($path)->encode(false)->render();

            $html .= CustomTag::name('svg')
                ->attributes($svg)
                ->content(PHP_EOL . $path . PHP_EOL)
                ->encode(false)
                ->render() . PHP_EOL;
        }

        return $html;
    }
}
