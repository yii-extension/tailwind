<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Li;

final class NavBar extends Widget
{
    private bool $activateItems = true;
    private string $backGroundColorTheme = '';
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
    private string $textColorTheme = '';
    private array $ulAttributes = [];
    private string $liClass = 'nav-item';

    public function begin(): string
    {
        parent::begin();

        $new = clone $this;

        if (!isset($new->options['id'])) {
            $new->options['id'] = "{$new->getId()}-navbar";
        }

        if (!isset($new->containerItemsAttributes['id'])) {
            $new->containerItemsAttributes['id'] = "{$new->getId()}-items-navbar";
        }

        if ($new->loadDefaultTheme) {
            $new->loadDefaultTheme($new);
        }

        $html = Html::openTag('nav', $new->options) . "\n";
        $html .= Html::openTag('div', $new->containerAttributes) . "\n";
        $html .= $new->renderBrand() . "\n";
        $html .= Html::openTag('div', $new->containerItemsAttributes) . "\n";
        $html .= Html::openTag('ul', $new->ulAttributes)  . "\n";

        $items = [];

        foreach ($this->items as $item) {
            if (!isset($item['visible']) || $item['visible']) {
                $items[] = Li::tag()
                    ->class($new->liClass)
                    ->content($this->renderItem($item))
                    ->encode(false);
            }
        }

        if ($items !== []) {
            $html .= implode("\n", $items) . "\n";
        }

        return $html;
    }

    protected function run(): string
    {
        $html = Html::closeTag('ul') . "\n";
        $html .= Html::closeTag('div') . "\n";
        $html .= Html::closeTag('div') . "\n";
        $html .= Html::closeTag('nav');

        return $html;
    }

    /**
     * Background color theme.
     *
     * @param string $value
     *
     * @return self
     */
    public function backGroundColorTheme(string $value): self
    {
        if (!in_array($value, self::BG_ALL)) {
            $values = implode('", "', self::BG_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;

        Html::addCssClass($new->options, ['bg-color' => $value]);

        return $new;
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
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - dropdownOptions: array, optional, the HTML options that will passed to the {@see Dropdown} widget.
     * - items: array|string, optional, the configuration array for creating a {@see Dropdown} widget, or a string
     *   representing the dropdown menu.
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

    private function loadDefaultTheme(self $new): self
    {
        if ($new->backGroundColorTheme === '') {
            Html::addCssClass($new->options, [NavBar::BG_BLACK]);
        }

        Html::addCssClass(
            $new->options,
            ['relative', 'flex', 'flex-wrap', 'items-center', 'px-2', 'py-3', 'mb-3'],
        );

        Html::addCssClass(
            $new->containerAttributes,
            ['container', 'px-4', 'mx-auto', 'flex', 'flex-wrap', 'items-center', 'justify-between'],
        );

        Html::addCssClass($new->containerItemsAttributes, ['lg:flex', 'flex-grow', 'items-center', 'hidden']);

        Html::addCssClass($new->ulAttributes, ['flex', 'flex-col', 'lg:flex-row', 'list-none', 'lg:ml-auto']);

        return $new;
    }

    /**
     * Checks whether a menu item is active.
     *
     * This is done by checking if {@see currentPath} match that specified in the `url` option of the menu item. When
     * the `url` option of a menu item is specified in terms of an array, its first element is treated as the
     * currentPath for the item and the rest of the elements are the associated parameters. Only when its currentPath
     * and parameters match {@see currentPath}, respectively, will a menu item be considered active.
     *
     * @param array|object|string $item the menu item to be checked
     *
     * @return bool whether the menu item is active
     */
    private function isItemActive($item): bool
    {
        if (isset($item['active'])) {
            return $item['active'];
        }

        return
            isset($item['url']) &&
            $this->currentPath !== '/' &&
            $item['url'] === $this->currentPath &&
            $this->activateItems;
    }

    private function renderBrand(): string
    {
        $brandImage = '';

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
                    'w-full',
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
                    'text-white',
                    'uppercase',
                    'whitespace-nowrap',
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

        $brand .= $new->renderToggleButton() . "\n";
        $brand .= Html::closeTag('div');

        return $brand;
    }

    private function renderIcon(string $label, string $icon, array $iconOptions): string
    {
        if ($icon !== '') {
            $label = "\n" . Html::openTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon]) .
                Html::closeTag('span') .
                Html::tag('span', $label) . "\n";
        }

        return $label;
    }

    /**
     * Renders a widget's item.
     *
     * @param array $item the item to render.
     *
     * @throws InvalidArgumentException|JsonException
     *
     * @return string the rendering result.
     */
    private function renderItem(array $item): string
    {
        if (!isset($item['label'])) {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        $dropdown = false;
        $encodeLabels = $item['encode'] ?? false;

        if ($encodeLabels) {
            $label = Html::encode($item['label']);
        } else {
            $label = $item['label'];
        }

        $iconOptions = [];

        $icon = $item['icon'] ?? '';

        $label = $this->renderIcon($label, $icon, $iconOptions);

        $options = $item['options'] ?? [];
        $items = $item['items'] ?? [];
        $url = $item['url'] ?? '#';
        $linkOptions = $item['linkOptions'] ?? [];
        $disabled = $item['disabled'] ?? false;

        $active = $this->isItemActive($item);

        if ($disabled) {
            Html::addCssStyle($linkOptions, 'opacity:.75; pointer-events:none;');
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, ['active' => 'is-active']);
        }

        if ($this->loadDefaultTheme) {
            Html::addCssClass(
                $linkOptions,
                [
                    'flex',
                    'font-bold',
                    'hover:opacity-75',
                    'items-center',
                    'leading-snug',
                    'px-3',
                    'py-2',
                    'text-white',
                    'text-xs',
                    'uppercase',
                ],
            );
        }

        return "\n" . Html::a($label, $url, $linkOptions)->encode(false)->render() . "\n";
    }

    private function renderToggleButton(): Button
    {
        $id = $this->containerItemsAttributes['id'];
        $this->toggleAttributes['onclick'] = "toggleNavbar('$id')";

        return Html::button('&#9776;', $this->toggleAttributes)->encode(false);
    }
}
