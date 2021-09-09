<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use InvalidArgumentException;
use ReflectionException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;

use function implode;

/**
 * The dropdown component is a container for a dropdown button and a dropdown menu.
 *
 * @link https://tailwindui.com/components/application-ui/elements/dropdowns
 */
final class Dropdown extends Widget
{
    private array $buttonAttributes = [];
    private string $buttonCssClass = 'font-semibold py-2 px-4 rounded inline-flex items-center';
    private string $buttonBgColorCssClass = 'bg-gray-600';
    private array $buttonIconAttributes = [];
    private string $buttonIconCssClass = 'pl-2 not-italic';
    private string $buttonIconText = '🠋';
    private string $buttonLabel = 'Click Me';
    private array $buttonLabelAttributes = [];
    private string $buttonTextColorCssClass = 'text-white';
    private string $dropdownCssClass = 'dropdown inline-block relative';
    private string $dropdownItemsCssClass = 'dropdown';
    private string $dropdownItemContentCssClass = 'dropdown-content absolute hidden pt-1 w-full';
    private bool $encloseByContainer = true;
    private array $items = [];
    private string $itemsActiveCssClass = 'bg-gray-400 text-blue-500';
    private string $itemsDisabledCssClass = 'opacity-50 cursor-not-allowed';
    private string $submenuCssClass = 'py-2 px-2 block whitespace-nowrap';
    private string $submenuContentCssClass = 'dropdown-content absolute hidden';
    private string $submenuItemsCssClass = 'py-2 px-2 block whitespace-nowrap';

    /**
     * @throws ReflectionException
     */
    protected function run(): string
    {
        $new = clone $this;
        return $new->items !== [] ? $new->dropdown($new) : '';
    }

    public function buttonAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonAttributes = $value;
        return $new;
    }

    public function buttonCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonCssClass = $value;
        return $new;
    }

    public function buttonBgColorCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonBgColorCssClass = $value;
        return $new;
    }

    public function buttonLabel(string $value): self
    {
        $new = clone $this;
        $new->buttonLabel = $value;
        return $new;
    }

    public function buttonIconAttributes(array $value): self
    {
        $new = clone $this;
        $new->buttonIconAttributes = $value;
        return $new;
    }

    public function buttonIconCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonIconCssClass = $value;
        return $new;
    }

    public function buttonIconText(string $value): self
    {
        $new = clone $this;
        $new->buttonIconText = $value;
        return $new;
    }

    public function buttonTextColorCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonTextColorCssClass = $value;
        return $new;
    }

    public function dropdownCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownCssClass = $value;
        return $new;
    }

    public function dropdownItemsCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemsCssClass = $value;
        return $new;
    }

    public function dropdownItemContentCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemContentCssClass = $value;
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

    public function itemsDisabledCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemsDisabledCssClass = $value;
        return $new;
    }

    public function submenuCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuCssClass = $value;
        return $new;
    }

    public function submenuItemsCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuItemsCssClass = $value;
        return $new;
    }

    public function submenuContentCssClass(string $value): self
    {
        $new = clone $this;
        $new->submenuContentCssClass = $value;
        return $new;
    }

    /**
     * If the widget should be unclosed by container.
     *
     * @param bool $value
     *
     * @return static
     */
    public function unClosedByContainer(bool $value = false): self
    {
        $new = clone $this;
        $new->encloseByContainer = $value;
        return $new;
    }

    /**
     * @throws ReflectionException
     */
    private function dropdown(self $new): string
    {
        $attributes = $new->getAttributes();
        $id = '';

        if (!isset($attributes['id'])) {
            $id = "{$new->getId()}-dropdown";
        }

        Html::addCssClass($attributes, $new->dropdownCssClass);

        $html = $new->dropdownItems($new);

        if ($new->encloseByContainer) {
            $button = $new->dropdownButton($new);
            $ul = Div::tag()
                ->class($new->dropdownItemContentCssClass)
                ->content(PHP_EOL . $html . PHP_EOL)
                ->encode(false)
                ->render();
            $html = Div::tag()
                ->attributes($attributes)
                ->content(PHP_EOL . $button . $ul . PHP_EOL)
                ->encode(false)
                ->id($id)
                ->render();
        }

        return $html;
    }

    private function dropdownButton(self $new): string
    {
        Html::addCssClass(
            $new->buttonAttributes,
            [$new->buttonBgColorCssClass, $new->buttonCssClass, $new->buttonTextColorCssClass]
        );

        Html::addCssClass($new->buttonIconAttributes, $new->buttonIconCssClass);

        return Button::tag()
            ->attributes($new->buttonAttributes)
            ->content(
                Span::tag()->attributes($new->buttonLabelAttributes)->content($new->buttonLabel) .
                CustomTag::name('i')->attributes($new->buttonIconAttributes)->content($new->buttonIconText)->render()
            )
            ->encode(false)
            ->render() . PHP_EOL;
    }

    /**
     * Renders menu items.
     *
     * @throws InvalidArgumentException|ReflectionException if the label option is not specified in one of the items.
     *
     * @return string the rendering result.
     */
    private function dropdownItems(self $new): string
    {
        $lines = [];

        /** @var array|string $item */
        foreach ($new->items as $item) {
            if (!isset($item['label']) && $item !== '-') {
                throw new InvalidArgumentException('The "label" option is required.');
            }

            if (is_array($item)) {
                /** @var string */
                $label = $item['label'] ?? '';

                /** @var array */
                $labelAttributes = $item['labelAttributes'] ?? [];

                if (isset($item['encode']) && $item['encode'] === true) {
                    $label = Html::encode($label);
                }

                /** @var array */
                $items = $item['items'] ?? [];

                /** @var array */
                $itemsAttributes = $item['itemsAttributes'] ?? [];

                /** @var array */
                $attributes = $item['attributes'] ?? [];

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

                /** @var string */
                $url = $item['url'] ?? '#';

                /** @var bool */
                $active = $item['active'] ?? false;

                /** @var bool */
                $disabled = $item['disable'] ?? false;

                Html::addCssClass($urlAttributes, $new->submenuItemsCssClass);

                if ($disabled) {
                    Html::addCssClass($urlAttributes, $new->itemsDisabledCssClass);
                } elseif ($active) {
                    Html::addCssClass($urlAttributes, $new->itemsActiveCssClass);
                }

                $itemIcon = $new->dropdownItemIcon($iconText, $iconCssClass, $iconAttributes);
                $itemLabel =  $itemIcon . $label;

                if ($iconAlign === 'right') {
                    $itemLabel =  $label . $itemIcon;
                }

                if ($items === []) {
                    $lines[] = $new->dropdownItemsLinks($itemLabel, $url, $urlAttributes);
                } else {
                    /** @var array */
                    Html::addCssClass($labelAttributes, $new->submenuCssClass);
                    Html::addCssClass($itemsAttributes, $new->dropdownItemsCssClass);

                    $link = A::tag()->attributes($labelAttributes)->content($itemLabel)->encode(false)->url($url)->render();
                    $dropdown = $new->dropdownMultipleLevel($new, $attributes, $items);
                    $lines[] = Div::tag()
                        ->attributes($itemsAttributes)
                        ->content(PHP_EOL . $link . PHP_EOL . $dropdown . PHP_EOL)
                        ->encode(false)
                        ->render();
                }
            }
        }

        return implode(PHP_EOL, $lines);
    }

    private function dropdownItemsLinks(string $itemLabel, string $url, array $urlAttributes): string
    {
        return A::tag()->attributes($urlAttributes)->content($itemLabel)->encode(false)->url($url)->render();
    }

    /**
     * @throws ReflectionException
     */
    private function dropdownMultipleLevel(self $new, array $attributes, array $items): string
    {
        Html::addCssClass($attributes, $new->submenuContentCssClass);

        $dropdown = Dropdown::widget()
            ->dropdownCssClass($new->dropdownCssClass)
            ->dropdownItemsCssClass($new->dropdownItemsCssClass)
            ->dropdownItemContentCssClass($new->dropdownItemContentCssClass)
            ->items($items)
            ->itemsActiveCssClass($new->itemsActiveCssClass)
            ->itemsDisabledCssClass($new->itemsDisabledCssClass)
            ->submenuCssClass($new->submenuCssClass)
            ->submenuItemsCssClass($new->submenuItemsCssClass)
            ->submenuContentCssClass($new->submenuContentCssClass)
            ->unClosedByContainer()
            ->render();

        return Div::tag()
            ->attributes($attributes)
            ->content(PHP_EOL . $dropdown . PHP_EOL)
            ->encode(false)
            ->render();
    }

    private function dropdownItemIcon(string $iconText, string $iconCssClass, array $iconAttributes): string
    {
        Html::addCssClass($iconAttributes, $iconCssClass);

        return ($iconText !== '' || $iconCssClass !== '')
            ? CustomTag::name('i')->attributes($iconAttributes)->content($iconText)->render()
            : '';
    }
}
