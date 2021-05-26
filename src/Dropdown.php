<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use InvalidArgumentException;
use Yiisoft\Html\Html;

use function implode;
use function is_array;

/**
 * The dropdown component is a container for a dropdown button and a dropdown menu.
 *
 * @link https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/javascript/dropdown
 */
final class Dropdown extends Widget
{
    protected string $backgroundColorTheme = Dropdown::BG_BLUGRAY;
    private bool $activateItems = true;
    private array $buttonAttributes = [];
    private string $buttonLabel = 'Dropdown';
    private array $buttonLabelAttributes = [];
    private array $buttonSubDropdownAttributes = [];
    private string $buttonSubDropdownBackgroundColor = 'bg-transparent';
    private string $buttonSubDropdownTextColor = 'text-black';
    private string $buttonIcon = '&#8595;';
    private array $containerAttributes = [];
    private array $containerTriggerAttributes = [];
    private string $currentPath = '';
    private array $dividerAttributes = [];
    private array $items = [];
    private array $itemsContainerAttributes = [];
    private array $urlAttributes = [];

    protected function run(): string
    {
        $new = clone $this;

        if ($new->loadDefaultTheme) {
            $new->loadDefaultTheme($new);
        }

        if (!isset($new->attributes['id'])) {
            $new->attributes['id'] = "{$new->getId()}-dropdown";
        }

        if (!isset($new->itemsContainerAttributes['id'])) {
            $new->itemsContainerAttributes['id'] = "{$new->getId()}-dropdown-items";
        }

        return
            Html::openTag('div', $new->attributes) . "\n" .
                Html::openTag('div', $new->containerAttributes) . "\n" .
                    Html::openTag('div', $new->containerTriggerAttributes) . "\n" .
                        $new->buildTrigger($new) .
                        $new->renderItems($new) .
                    Html::closeTag('div') . "\n" .
                Html::closeTag('div') . "\n" .
            Html::closeTag('div');
    }

    /**
     * The HTML attributes for the widget button tag.
     *
     * @param array $value
     *
     * @return self
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
     * Set label for the dropdown button.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLabel(string $value): self
    {
        $new = clone $this;
        $new->buttonLabel = $value;
        return $new;
    }

    /**
     * The HTML attributes for the dropdown button.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonLabelAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonLabelAttributes = $value;
        return $new;
    }

    /**
     * Set icon for the dropdown button.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonIcon(string $value): self
    {
        $new = clone $this;
        $new->buttonIcon = $value;
        return $new;
    }

    /**
     * The HTML attributes for the widget button sub dropdown tag.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonSubDropdownAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonSubDropdownAttributes = $value;
        return $new;
    }

    /**
     * Button background color.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonSubDropdownBackgroundColor(string $value): self
    {
        if (!in_array($value, self::BG_ALL)) {
            $values = implode('", "', self::BG_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->buttonSubDropdownBackgroundColor = $value;
        return $new;
    }

    /**
     * Button text color label.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonSubDropdownTextColor(string $value): self
    {
        $new = clone $this;
        $new->buttonSubDropdownTextColor = $value;
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
     * The HTML attributes for the dropdown divider.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function dividerAttributes(array $value): self
    {
        $new = clone $this;
        $new->dividerAttributes = $value;
        return $new;
    }

    /**
     * List of menu items in the dropdown. Each array element can be either an HTML string, or an array representing a
     * single menu with the following structure:
     *
     * - label: string, required, the label of the item link.
     * - encode: bool, optional, whether to HTML-encode item label.
     * - url: string|array, optional, the URL of the item link. This will be processed by {@see currentPath}.
     *   If not set, the item will be treated as a menu header when the item has no sub-menu.
     * - urlAttributes: array, optional, the HTML attributes of the item link.
     * - itemsAttributes: array, optional, the HTML attributes of the item.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *
     * To insert divider use `-`.
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
     * The HTML attributes for the widget items.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function itemsContainerAttributes(array $value): self
    {
        $new = clone $this;
        $new->itemsContainerAttributes = $value;
        return $new;
    }

    private function buildTrigger(self $new): string
    {
        /** @var string */
        $id = $new->itemsContainerAttributes['id'];
        $new->buttonAttributes['onclick'] = "openDropdown(event, '$id')";
        $new->buttonAttributes['encode'] = false;

        return
            Html::openTag('button', $new->buttonAttributes) .
                Html::tag('span', $new->buttonLabel, $new->buttonLabelAttributes) .
                Html::tag('i', $new->buttonIcon, ['class' => 'pl-2'])->encode(false) .
            Html::closeTag('button') . "\n";
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

    private function loadDefaultTheme(self $new): void
    {
        if ($new->attributes === []) {
            Html::addCssClass($new->attributes, ['flex', 'flex-wrap']);
        }

        if ($new->containerAttributes === []) {
            Html::addCssClass($new->containerAttributes, ['md:w-4/12', 'px-4', 'sm:w-6/12', 'w-full']);
        }

        if ($new->containerTriggerAttributes === []) {
            Html::addCssClass($new->containerTriggerAttributes, ['align-middle', 'inline-flex', 'relative', 'w-full']);
        }

        if ($new->buttonAttributes === []) {
            Html::addCssClass(
                $new->buttonAttributes,
                [
                    $new->backgroundColorTheme,
                    $new->textColorTheme,
                    'duration-150',
                    'ease-linear',
                    'focus:outline-none',
                    'font-bold',
                    'hover:shadow-lg',
                    'mb-1',
                    'mr-1',
                    'outline-none',
                    'px-6',
                    'py-3',
                    'rounded',
                    'shadow',
                    'text-sm',
                    'transition-all',
                    'uppercase',
                ]
            );
        }

        if ($new->itemsContainerAttributes === []) {
            Html::addCssClass(
                $new->itemsContainerAttributes,
                [
                    'float-left',
                    'hidden bg-white',
                    'list-none',
                    'mt-1',
                    'py-2',
                    'rounded',
                    'shadow-lg',
                    'text-base',
                    'text-left',
                    'z-50',
                ]
            );

            Html::addCssStyle($new->itemsContainerAttributes, 'min-width:12rem');
        }

        if ($new->urlAttributes === []) {
            Html::addCssClass(
                $new->urlAttributes,
                [
                    'block',
                    'font-normal',
                    'px-4',
                    'py-2',
                    'text-sm',
                    'w-full',
                    'whitespace-nowrap',
                ]
            );
        }

        if ($new->dividerAttributes === []) {
            Html::addCssClass(
                $new->dividerAttributes,
                [
                    'border-blueGray-800',
                    'border-solid',
                    'border-t-0',
                    'border',
                    'h-0',
                    'my-2',
                    'opacity-25',
                ]
            );
        }

        if ($new->buttonSubDropdownAttributes === []) {
            Html::addCssClass(
                $new->buttonSubDropdownAttributes,
                [
                    $new->buttonSubDropdownBackgroundColor,
                    $new->buttonSubDropdownTextColor,
                    'duration-150',
                    'ease-linear',
                    'focus:outline-none',
                    'hover:shadow-lg',
                    'mb-1',
                    'mr-1',
                    'outline-none',
                    'py-3',
                    'rounded',
                    'shadow',
                    'text-sm',
                    'transition-all',
                ],
            );
        }
    }

    private function renderLabel(
        string $label,
        string $icon,
        array $iconAttributes = [],
        array $labelAttributes = []
    ): string {
        $html = '';

        if ($icon !== '') {
            $html = "\n" .
                Html::openTag('span', $iconAttributes) .
                    Html::tag('i', '', ['class' => $icon]) .
                Html::closeTag('span') . "\n";
        }

        if ($label !== '') {
            $html .= Html::span($label, $labelAttributes);
        }

        return $html;
    }

    /**
     * Renders menu items.
     *
     * @return string the rendering result.
     *
     * @throws InvalidArgumentException if the label option is not specified in one of the items.
     */
    private function renderItems(self $new): string
    {
        $lines = [];

        /** @var array|string $item */
        foreach ($new->items as $item) {
            if ($item === '-') {
                $lines[] = Html::div('', $new->dividerAttributes);
            } else {
                if (!isset($item['label']) && $item !== '-') {
                    throw new InvalidArgumentException('The "label" option is required.');
                }

                /** @var string */
                $itemLabel = $item['label'] ?? '';

                if (isset($item['encode']) && $item['encode'] === true) {
                    $itemLabel = Html::encode($itemLabel);
                }

                /** @var array */
                $labelAttributes = isset($item['labelAttributes']) ? $item['labelAttributes'] : [];

                /** @var array */
                $urlAttributes = isset($item['urlAttributes']) ? $item['urlAttributes'] : [];

                /** @var string */
                $icon = $item['icon'] ?? '';

                /** @var array */
                $iconAttributes = $item['iconAttributes'] ?? [];

                /** @var string */
                $url = $item['url'] ?? '';

                /** @var bool */
                $active = $item['active'] ?? $new->isItemActive($url, $new->currentPath, $new->activateItems);

                $label = $new->renderLabel($itemLabel, $icon, $iconAttributes, $labelAttributes);

                if ($new->activateItems && $active) {
                    Html::addCssClass($urlAttributes, ['bg-gray-900', 'text-white']);
                } else {
                    Html::addCssClass($urlAttributes, 'text-blueGray-700 bg-transparent');
                }

                if (isset($item['items']) && is_array($item['items'])) {
                    $lines[] = Dropdown::widget()
                        ->backgroundColorTheme(Dropdown::BG_TRANSPARENT)
                        ->buttonAttributes($new->buttonSubDropdownAttributes)
                        ->buttonIcon('&#8594;')
                        ->buttonLabel($itemLabel)
                        ->items($item['items'])
                        ->textColorTheme('text-black');
                } else {
                    $lines[] = Html::a($label, $url, array_merge_recursive($new->urlAttributes, $urlAttributes))
                        ->encode(false);
                }
            }
        }

        $items = '';

        if (!empty($lines)) {
            $items = implode("\n", $lines) . "\n";
        }

        return
            Html::openTag('div', $new->itemsContainerAttributes) . "\n" .
                $items .
            Html::closeTag('div') . "\n" ;
    }
}
