<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;

/**
 * Alert renders an alert bootstrap component.
 *
 * @link https://tailwindui.com/components/application-ui/feedback/alerts
 */
final class Alert extends Widget
{
    private array $buttonAttributes = [];
    private string $buttonIconText = '&times;';
    private bool $buttonEnable = true;
    private string $containerCssClass = '';
    private array $iconContainerAttributes = [];
    private array $iconAttributes = [];
    private string $iconCssClass = '';
    private string $iconText = '';
    private string $message = '';
    private array $messageAttributes = [];
    private array $parts = [];
    private string $template = '{message}{button}';
    private string $title = '';
    private array $titleAttributes = [];

    protected function run(): string
    {
        $new = clone $this;

        $attributes = $new->getAttributes();

        $title = '';

        if ($new->title !== '') {
            $title = $new->alertMessageTitle($new);
        }

        if (!isset($attributes['id'])) {
            $attributes['id'] = "{$new->getId()}-alert";
        }

        if (!isset($new->parts['{icon}'])) {
            $new->alertIcon($new);
        }

        if (!isset($new->parts['{message}'])) {
            $new->alertMessage($new);
        }

        if (!isset($new->parts['{button}'])) {
            $new->alertCloseButton($new);
        }

        $html = strtr($new->template, $new->parts);

        if ($new->containerCssClass !== '') {
            $html = Div::tag()
                ->class($new->containerCssClass)
                ->content(PHP_EOL . $title . $html . PHP_EOL)
                ->encode(false)
                ->render();
        }

        return $new->message !== ''
            ? Div::tag()
                ->attributes($attributes)
                ->content(PHP_EOL . trim($html) . PHP_EOL)
                ->encode(false)
                 ->render()
            : '';
    }

    /**
     * The attributes for rendering the close button tag.
     *
     * The close button is displayed in the header of the modal window. Clicking on the button will hide the modal
     * window.
     *
     * If {@see closeButtonEnabled} is false, no close button will be rendered.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
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

    public function containerCssClass(string $value): self
    {
        $new = clone $this;
        $new->containerCssClass = $value;
        return $new;
    }

    /**
     * The icon css class message in the alert component.
     *
     * @param string $value
     *
     * @return static
     */
    public function iconCssClass(string $value): self
    {
        $new = clone $this;
        $new->iconCssClass = $value;
        return $new;
    }

    public function iconContainerAttributes(array $value): self
    {
        $new = clone $this;
        $new->iconContainerAttributes = $value;
        return $new;
    }

    /**
     * The icon text message in the alert component.
     *
     * @param string $value
     *
     * @return static
     */
    public function iconText(string $value): self
    {
        $new = clone $this;
        $new->iconText = $value;
        return $new;
    }

    /**
     * The message content in the alert component. Alert widget will also be treated as the message content, and will be
     * rendered before this.
     *
     * @param string $value
     *
     * @return static
     */
    public function message(string $value): self
    {
        $new = clone $this;
        $new->message = $value;
        return $new;
    }

    public function messageAttributes(array $value): self
    {
        $new = clone $this;
        $new->messageAttributes = $value;
        return $new;
    }

    public function template(string $value): self
    {
        $new = clone $this;
        $new->template = $value;
        return $new;
    }

    public function title(string $value): self
    {
        $new = clone $this;
        $new->title = $value;
        return $new;
    }

    public function titleAttributes(array $value): self
    {
        $new = clone $this;
        $new->titleAttributes = $value;
        return $new;
    }

    /**
     * Disable close button.
     *
     * @return static
     */
    public function withoutButtonClose(): self
    {
        $new = clone $this;
        $new->buttonEnable = false;
        return $new;
    }

    /**
     * Renders the alert close button.
     *
     * @param self $new
     */
    private function alertCloseButton(self $new): void
    {
        $new->buttonAttributes['onclick'] = 'closeAlert(event)';

        $new->parts['{button}'] = '';

        if ($new->buttonEnable) {
            $new->parts['{button}'] = Button::tag()
                ->attributes($new->buttonAttributes)
                ->content($new->buttonIconText)
                ->encode(false)
                ->type('button')
                ->render();
        }
    }

    /**
     * Render the alert icon.
     *
     * @param self $new
     */
    private function alertIcon(self $new): void
    {
        Html::addCssClass($new->iconAttributes, $new->iconCssClass);

        $icon = CustomTag::name('i')->attributes($new->iconAttributes)->content($new->iconText)->render();

        $new->parts['{icon}'] = Div::tag()
            ->attributes($new->iconContainerAttributes)
            ->content($icon)
            ->encode(false)
            ->render() . PHP_EOL;
    }

    /**
     * Render the alert message.
     *
     * @param self $new
     */
    private function alertMessage(self $new): void
    {
        $tag = Span::tag()->attributes($new->messageAttributes)->content($new->message)->encode(false)->render();

        $new->parts['{message}'] = $tag . PHP_EOL;
    }

    /**
     * Render the alert message title.
     *
     * @param self $new
     *
     * @return string
     */
    private function alertMessageTitle(self $new): string
    {
        return Div::tag()
            ->attributes($new->titleAttributes)
            ->content($new->title)
            ->encode(false)
            ->render() . PHP_EOL;
    }
}
