<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Li;

/**
 * This the upper navigation of your website. You can add in it links, icons, links with icons, search bars and a brand
 * text.
 *
 * @link https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/css/navbars
 */
final class NavBar extends Widget
{
    private bool $activateItems = true;
    private string $brand = '';
    private string $brandImage = '';
    private array $brandImageAttributes = [];
    private string $brandLink = '/';
    private array $brandAttributes = [];
    private string $brandText = '';
    private array $brandTextAttributes = [];
    private array $containerAttributes = [];
    private array $containerItemsAttributes = [];
    private string $currentPath = '';
    private array $items = [];
    private bool $loadDefaultTheme = true;
    private array $toggleAttributes = [];
    private array $ulAttributes = [];
    private string $liClass = 'nav-item';

    public function begin(): string
    {
        parent::begin();

        $new = clone $this;

        if ($new->loadDefaultTheme) {
            $new->loadDefaultTheme($new);
        }

        if (!isset($new->attributes['id'])) {
            $new->attributes['id'] = "{$new->getId()}-navbar";
        }

        if (!isset($new->containerItemsAttributes['id'])) {
            $new->containerItemsAttributes['id'] = "{$new->getId()}-items-navbar";
        }

        return
            Html::openTag('nav', $new->attributes) . "\n" .
            Html::openTag('div', $new->containerAttributes) . "\n" .
            $new->renderBrand() . "\n" .
            $new->renderToggleButton() .
            Html::openTag('div', $new->containerItemsAttributes) . "\n" .
            Html::openTag('ul', $new->ulAttributes)  . "\n" .
            $new->renderItem($new) .
            Html::closeTag('ul') . "\n";
    }

    protected function run(): string
    {
        return
            Html::closeTag('div') . "\n" .
            Html::closeTag('div') . "\n" .
            Html::closeTag('nav');
    }

    /**
     * Set render brand custom, {@see brandText} and {@see brandImage} are not generated.
     *
     * @param string $value
     *
     * @return self
     */
    public function brand(string $value): self
    {
        $new = clone $this;
        $new->brand = $value;
        return $new;
    }

    /**
     * Src of the brand image or empty if it's not used. Note that this param will override `$this->brandText` param.
     *
     * @param string $value
     *
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function brandTextAttributes(array $value): self
    {
        $new = clone $this;
        $new->brandTextAttributes = $value;
        return $new;
    }

    /**
     * The HTML attributes for the container navbar. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function containerAttributes(array $value): self
    {
        $new = clone $this;
        $new->containerAttributes = $value;

        return $new;
    }

    /**
     * The HTML attributes for the container items navbar. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function containerItemsAttributes(array $value): self
    {
        $new = clone $this;
        $new->containerItemsAttributes = $value;

        return $new;
    }

    /**
     * Allows you to assign the current path of the url from request controller.
     *
     * @param string $value
     *
     * @return self
     */
    public function currentPath(string $value): self
    {
        $new = clone $this;
        $new->currentPath = $value;
        return $new;
    }

    /**
     * List of items in the nav widget. Each array element represents a single  menu item which can be either a string
     * or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - urlAttributes: array, optional, the HTML attributes of the item's link.
     * - active: bool, optional, whether the item should be on active state or not.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for
     *   only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * @param array $value
     *
     * @return self
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * Class for tag li.
     *
     * @param string $value
     *
     * @return self
     */
    public function liClass(string $value): self
    {
        $new = clone $this;
        $new->liClass = $value;
        return $new;
    }

    /**
     * The HTML attributes of the navbar toggler button.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function toggleAttributes(array $value): self
    {
        $new = clone $this;
        $new->toggleAttributes = $value;
        return $new;
    }

    /**
     * The HTML attributes for the container ul attributes. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function ulAttributes(array $value): self
    {
        $new = clone $this;
        $new->ulAttributes = $value;
        return $new;
    }

    /**
     * Disable activate items according to whether their currentPath.
     *
     * @return $this
     *
     * {@see isItemActive}
     */
    public function withoutActivateItems(): self
    {
        $new = clone $this;
        $new->activateItems = false;
        return $new;
    }


    /**
     * Disable load default css classes.
     *
     * @return self
     */
    public function withoutLoadDefaultTheme(): self
    {
        $new = clone $this;
        $new->loadDefaultTheme = false;
        return $new;
    }

    private function loadDefaultTheme(self $new): void
    {
        if ($new->attributes === []) {
            Html::addCssClass($new->attributes, [$new->backgroundColorTheme]);

            Html::addCssClass(
                $new->attributes,
                ['flex-wrap', 'flex', 'items-center', 'mb-3', 'px-2', 'py-3', 'relative']
            );
        }

        if ($new->containerAttributes === []) {
            Html::addCssClass(
                $new->containerAttributes,
                ['container', 'flex-wrap', 'flex', 'items-center', 'justify-between', 'mx-auto','px-4']
            );
        }

        if ($new->containerItemsAttributes === []) {
            Html::addCssClass(
                $new->containerItemsAttributes,
                ['flex-grow', 'hidden', 'items-center', 'lg:flex']
            );
        }

        if ($new->ulAttributes === []) {
            Html::addCssClass(
                $new->ulAttributes,
                ['flex-col', 'flex', 'lg:flex-row', 'lg:ml-auto', 'list-none']
            );
        }

        if ($new->toggleAttributes === []) {
            Html::addCssClass(
                $new->toggleAttributes,
                [
                    'block',
                    'border-solid',
                    'border-transparent',
                    'border',
                    'cursor-pointer',
                    'focus:outline-none',
                    'leading-none',
                    'lg:hidden',
                    'outline-none',
                    'px-3',
                    'py-1',
                    'rounded bg-transparent',
                    'text-xl',
                    $new->textColorTheme,
                ]
            );
        }
    }

    /**
     * Checks whether a menu item is active.
     *
     * This is done by checking if {@see currentPath} match that specified in the `url` option of the menu item. When
     * the `url` option of a menu item is specified in terms of an array, its first element is treated as the
     * currentPath for the item and the rest of the elements are the associated parameters. Only when its currentPath
     * and parameters match {@see currentPath}, respectively, will a menu item be considered active.
     *
     * @param string $url
     * @param string $currentPath
     * @param bool $activateItems
     *
     * @return bool whether the menu item is active
     */
    private function isItemActive(string $url, string $currentPath, bool $activateItems): bool
    {
        return $currentPath !== '/' && $url === $currentPath && $activateItems;
    }

    private function renderBrand(): string
    {
        $new = clone $this;

        if ($new->brand !== '') {
            return $new->brand;
        }

        if ($new->loadDefaultTheme) {
            Html::addCssClass(
                $new->brandAttributes,
                [
                    'flex',
                    'justify-between',
                    'lg:justify-start',
                    'lg:static',
                    'lg:w-auto',
                    'px-4',
                    'relative',
                ],
            );

            Html::addCssClass(
                $new->brandTextAttributes,
                [
                    'font-bold',
                    'inline-block',
                    'leading-relaxed',
                    'px-4',
                    'text-sm',
                    'uppercase',
                    'whitespace-nowrap',
                    $new->textColorTheme,
                ],
            );
        }

        $brand = Html::openTag('div', $new->brandAttributes) . "\n";

        if ($new->brandImage !== '') {
            $brand .= Html::img($new->brandImage)->attributes($new->brandImageAttributes) . "\n";
        }

        if ($new->brandImage !== '' && $new->brandText !== '') {
            $brand .= Html::a($new->brandText, $new->brandLink, $new->brandTextAttributes) . "\n";
        }

        if ($new->brandText !== '' && $new->brandImage === '') {
            if (empty($new->brandLink)) {
                $brand .= Html::span($new->brandText, $new->brandTextAttributes);
            } else {
                $brand .= Html::a($new->brandText, $new->brandLink, $new->brandTextAttributes) . "\n";
            }
        }

        $brand .= Html::closeTag('div');

        return $brand;
    }

    private function renderLabel(
        string $label,
        string $icon,
        array $iconAttributes = [],
        array $labelAttributes = []
    ): string {
        if ($icon !== '') {
            $icon = "\n" .
                Html::openTag('span', $iconAttributes) .
                    Html::tag('i', '', ['class' => $icon]) .
                Html::closeTag('span') . "\n";
        }

        if ($label !== '') {
            $label = Html::span($label, $labelAttributes)->encode(false)->render();
        }

        return $icon . $label;
    }

    private function renderItem(self $new): string
    {
        $items = [];

        /** @var array $item */
        foreach ($new->items as $item) {
            if (!isset($item['visible']) || $item['visible']) {
                $items[] = Li::tag()->class($new->liClass)->content($new->renderItems($item))->encode(false);
            }
        }

        return $items !== [] ? implode("\n", $items) . "\n" : '';
    }

    private function renderItems(array $item): string
    {
        if (!isset($item['label']) && !isset($item['icon'])) {
            throw new InvalidArgumentException('The "label" or "icon" option is required.');
        }

        /** @var string */
        $icon = $item['icon'] ?? '';

        /** @var array */
        $iconAttributes = $item['iconAttributes'] ?? [];

        /** @var string */
        $label = $item['label'] ?? '';

        /** @var array */
        $labelAttributes = isset($item['labelAttributes']) ? $item['labelAttributes'] : [];

        /** @var string */
        $url = $item['url'] ?? '#';

        /** @var array */
        $urlAttributes = isset($item['urlAttributes']) ? $item['urlAttributes'] : [];

        /** @var bool */
        $active = $item['active'] ?? $this->isItemActive($url, $this->currentPath, $this->activateItems);

        if (isset($item['encode']) && $item['encode'] === true) {
            $label = Html::encode($label);
        }

        $label = $this->renderLabel($label, $icon, $iconAttributes, $labelAttributes);

        if (isset($item['disabled']) && $item['disabled'] === true) {
            Html::addCssStyle($urlAttributes, 'opacity:.75; pointer-events:none;');
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($urlAttributes, ['active' => 'bg-gray-900']);
        }

        if ($this->loadDefaultTheme) {
            Html::addCssClass(
                $urlAttributes,
                [
                    'flex',
                    'font-bold',
                    'hover:opacity-75',
                    'items-center',
                    'leading-snug',
                    'px-3',
                    'py-2',
                    'text-xs',
                    'uppercase',
                    $this->textColorTheme,
                ],
            );
        }

        return "\n" . Html::a($label, $url, $urlAttributes)->encode(false)->render() . "\n";
    }

    private function renderToggleButton(): string
    {
        /** @var string */
        $id = $this->containerItemsAttributes['id'];
        $this->toggleAttributes['onclick'] = "toggleNavbar('$id')";

        return
            Html::openTag('div') . "\n" .
                Html::button('☰', $this->toggleAttributes) . "\n" .
            Html::closeTag('div') . "\n";
    }
}
