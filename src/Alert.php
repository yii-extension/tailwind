<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_merge;

/**
 * Alert renders an alert bootstrap component.
 *
 * @link https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/javascript/alerts
 */
final class Alert extends Widget
{
    protected string $backgroundColorTheme = Alert::BG_BLUGRAY;
    private array $buttonAttributes = [];
    private bool $buttonEnabled = true;
    private string $icon = '';
    private array $iconAttributes = [];
    private string $message = '';
    private array $messageAttributes = [];

    protected function run(): string
    {
        $new = clone $this;

        if ($new->loadDefaultTheme) {
            $new->loadDefaultTheme($new);
        }

        if (!isset($new->attributes['id'])) {
            $new->attributes['id'] = "{$new->getId()}-alert";
        }

        $message = $new->message !== '' ? $new->renderMessage($new) . "\n" : '';

        return
            Html::openTag('div', $new->attributes) . "\n" .
                $message .
                $new->renderButton($new) .
            Html::closeTag('div');
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
     * The icon message in the alert component.
     *
     * @param string $value
     *
     * @return self
     */
    public function icon(string $value): self
    {
        $new = clone $this;
        $new->icon = $value;
        return $new;
    }

    /**
     * The message content in the alert component. Alert widget will also be treated as the message content, and will be
     * rendered before this.
     *
     * @param string $value
     *
     * @return self
     */
    public function message(string $value): self
    {
        $new = clone $this;
        $new->message = $value;
        return $new;
    }

    /**
     * Disable close button.
     *
     * @return self
     */
    public function withoutButton(): self
    {
        $new = clone $this;
        $new->buttonEnabled = false;
        return $new;
    }

    private function loadDefaultTheme(self $new): void
    {
        if ($new->attributes === []) {
            Html::addCssClass(
                $new->attributes,
                [$new->backgroundColorTheme, 'border-0', 'mb-4', 'px-6', 'py-4', 'relative', 'rounded', 'text-white']
            );
        }

        if ($new->iconAttributes === []) {
            Html::addCssClass($new->iconAttributes, ['align-middle', 'inline-block', 'mr-5', 'text-xl']);
        }

        if ($new->messageAttributes === []) {
            Html::addCssClass($new->messageAttributes, ['align-middle', 'inline-block', 'mr-8', $new->textColorTheme]);
        }

        if ($new->buttonAttributes === []) {
            Html::addCssClass(
                $new->buttonAttributes,
                [
                    'absolute',
                    'bg-transparent',
                    'focus:outline-none',
                    'font-semibold',
                    'leading-none',
                    'mr-6',
                    'mt-4',
                    'outline-none',
                    'right-0',
                    'text-2xl',
                    'top-0',
                ]
            );
        }
    }

    /**
     * Renders the close button.
     *
     * @param self $new
     *
     * @return string the rendering result
     *
     * @throws JsonException
     */
    private function renderButton(self $new): string
    {
        $new->buttonAttributes['onclick'] = 'closeAlert(event)';

        if ($new->buttonEnabled === false) {
            return '';
        }

        return Html::button('x', $new->buttonAttributes) . "\n";
    }

    /**
     * Renders the alert body and the close button (if any).
     *
     * @throws JsonException
     *
     * @param self $new
     * @return string the rendering result
     */
    private function renderMessage(self $new): string
    {
        $html = '';

        if ($new->icon !== '') {
            $html =
                Html::openTag('span', $new->iconAttributes) .
                    Html::tag('i', '', ['class' => $new->icon]) .
                Html::closeTag('span') . "\n";
        }

        if ($new->message !== '') {
            $html .= Html::span($new->message, $new->messageAttributes)->encode(false);
        }

        return $html;
    }
}
