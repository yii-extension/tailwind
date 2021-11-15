<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use InvalidArgumentException;
use ReflectionException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;

use function implode;
use function is_array;

/**
 * Nav renders a nav HTML component.
 */
final class Nav extends Widget
{
    private bool $activateItems = true;
    private bool $activateParents = false;
    private string $currentPath = '';
    private array $items = [];
    private string $itemsActiveCssClass = 'text-blue-500';
    private string $itemsDisabledCssClass = 'opacity-50 pointer-events-none';
    private string $itemsCssClass = '';
    private string $itemsLinkCssClass = '';
    private string $submenuCssClass = '';
    private string $submenuContentCssClass = '';
    private string $submenuItemsCssClass = '';

    /**
     * @throws ReflectionException
     */
    protected function run(): string
    {
        $new  = clone $this;
        return $new->nav($new);
    }

    /**
     * Whether to activate parent menu items when one of the corresponding child menu items is active.
     *
     * @return static
     */
    public function activateParents(): self
    {
        $new = clone $this;
        $new->activateParents = true;
        return $new;
    }

    /**
     * Allows you to assign the current path of the url from request controller.
     *
     * @param string $value
     *
     * @return static
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
     * - dropdownAttributes: array, optional, the HTML options that will passed to the {@see Dropdown} widget.
     * - items: array|string, optional, the configuration array for creating a {@see Dropdown} widget, or a string
     *   representing the dropdown menu.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for
     *   only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * @param array $value
     *
     * @return static
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    public function itemsActiveCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemsActiveCssClass = $value;
        return $new;
    }

    public function itemsCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemsCssClass = $value;
        return $new;
    }

    public function itemsLinkCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemsLinkCssClass = $value;
        return $new;
    }

    public function submenuCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuCssClass = $value;
        return $new;
    }

    public function submenuContentCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuContentCssClass = $value;
        return $new;
    }

    public function submenuItemsCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuItemsCssClass = $value;
        return $new;
    }

    /**
     * Disable activate items according to whether their currentPath.
     *
     * @return static
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
     * Renders the given items as a dropdown.
     *
     * This method is called to create sub-menus.
     *
     * @param self $new
     * @param array $items the given items. Please refer to {@see Dropdown::items} for the array structure.
     *
     * @throws ReflectionException
     *
     * @return string the rendering result.
     */
    private function renderDropdown(self $new, array $items): string
    {
        return Dropdown::widget()
            ->items($items)
            ->submenuCssClass($new->submenuCssClass)
            ->submenuContentCssClass($new->submenuContentCssClass)
            ->submenuItemsCssClass($new->submenuItemsCssClass)
            ->unClosedByContainer()
            ->render() . PHP_EOL;
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     *
     * @param array $items
     * @param bool $active should the parent be active too
     *
     * @return array
     *
     * {@see items}
     */
    private function isChildActive(array $items, bool &$active = false): array
    {
        $new = clone $this;

        /** @var array|string $child */
        foreach ($items as $i => $child) {
            /** @var string */
            $url = $child['url'] ?? '#';

            /** @var bool */
            $active = $child['active'] ?? false;

            if ($active === false && is_array($items[$i])) {
                $items[$i]['active'] = $new->isItemActive($url, $new->currentPath, $new->activateItems);
            }

            if ($new->activateParents) {
                $active = true;
            }

            /** @var array */
            $childItems = $child['items'] ?? [];

            if ($childItems !== [] && is_array($items[$i])) {
                $items[$i]['items'] = $new->isChildActive($childItems);

                if ($active) {
                    $items[$i]['attributes'] = ['active' => true];
                    $active = true;
                }
            }
        }

        return $items;
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
        return ($currentPath !== '/') && ($url === $currentPath) && $activateItems;
    }

    /**
     * @throws ReflectionException
     */
    private function nav(self $new): string
    {
        $items = [];

        $attributes = $new->getattributes();

        /** @var array|string $item */
        foreach ($new->items as $item) {
            $visible = !isset($item['visible']) || $item['visible'];

            if ($visible) {
                $items[] = is_string($item) ? $item : $new->navItem($item);
            }
        }

        $links = PHP_EOL . implode("\n", $items) . PHP_EOL;

        $div = Div::tag()->attributes($attributes)->content($links)->encode(false)->render() . PHP_EOL;

        return $new->items !== [] ? $div : '';
    }

    /**
     * Renders a widget's item.
     *
     * @param array $item the item to render.
     *
     * @throws ReflectionException
     *
     * @return string the rendering result.
     */
    private function navItem(array $item): string
    {
        $new = clone $this;

        $html = '';

        if (!isset($item['label'])) {
            throw new InvalidArgumentException('The label option is required.');
        }

        /** @var string */
        $label = $item['label'] ?? '';

        if (isset($item['encode']) && $item['encode'] === true) {
            $label = Html::encode($label);
        }

        /** @var array */
        $items = $item['items'] ?? [];

        /** @var string */
        $url = $item['url'] ?? '#';

        /** @var array */
        $urlAttributes = $item['urlAttributes'] ?? [];

        /** @var string */
        $iconText = $item['iconText'] ?? '';

        /** @var string */
        $iconCssClass = $item['iconCssClass'] ?? '';

        /** @var array */
        $iconAttributes = $item['iconAttributes'] ?? [];

        /** @var string */
        $iconAlign = $item['iconAlign'] ?? 'left';

        /** @var bool */
        $active = $item['active'] ?? $new->isItemActive($url, $new->currentPath, $new->activateItems);

        /** @var bool */
        $disable = $item['disable'] ?? false;

        $itemIcon = $new->navItemsIcon($iconText, $iconCssClass, $iconAttributes);
        $itemLabel =  $itemIcon . $label;

        if ($iconAlign === 'right') {
            $itemLabel =  $label . $itemIcon;
        }

        if ($disable) {
            Html::addCssClass($urlAttributes, $new->itemsDisabledCssClass);
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($urlAttributes, $new->itemsActiveCssClass);
        }

        if ($items !== []) {
            $items = $new->isChildActive([$item], $active);

            $html = Div::tag()
                ->class($new->itemsCssClass)
                ->content(PHP_EOL . $new->renderDropdown($new, $items))
                ->encode(false)
                ->render();
        }

        if ($new->itemsLinkCssClass !== '') {
            Html::addCssClass($urlAttributes, $new->itemsLinkCssClass);
        }

        if ($html === '') {
            $html = A::tag()->attributes($urlAttributes)->content($itemLabel)->url($url)->encode(false)->render();
        }

        return $html;
    }

    private function navItemsIcon(string $iconText, string $iconCssClass, array $iconAttributes): string
    {
        if ($iconCssClass !== '') {
            Html::addCssClass($iconAttributes, $iconCssClass);
        }

        return ($iconText !== '' || $iconCssClass !== '')
            ? CustomTag::name('i')->attributes($iconAttributes)->content($iconText)->render()
            : '';
    }
}
