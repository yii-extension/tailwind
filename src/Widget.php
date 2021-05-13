<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use Yiisoft\Html\Html;

abstract class Widget extends \Yiisoft\Widget\Widget
{
    public const BG_AMBER = 'bg-amber-500';
    public const BG_BLACK = 'bg-black';
    public const BG_EMERALD = 'bg-emerald-500';
    public const BG_INDIGO = 'bg-indigo-500';
    public const BG_LIGHTBLUE = 'bg-lightBlue-500';
    public const BG_ORANGE = 'bg-orange-500';
    public const BG_PINK = 'bg-pink-500';
    public const BG_PURPLE = 'bg-purple-500';
    public const BG_RED = 'bg-red-500';
    public const BG_TEAL = 'bg-teal-500';
    public const BG_WHITE = 'bg-white';
    public const BG_ALL = [
        self::BG_AMBER,
        self::BG_BLACK,
        self::BG_EMERALD,
        self::BG_INDIGO,
        self::BG_LIGHTBLUE,
        self::BG_ORANGE,
        self::BG_PINK,
        self::BG_PURPLE,
        self::BG_RED,
        self::BG_TEAL,
        self::BG_WHITE,
    ];
    protected array $options = [];
    private ?string $id = null;
    private bool $autoGenerate = true;
    private string $autoIdPrefix = 'w';
    private static int $counter = 0;

    /**
     * Returns the Id of the widget.
     *
     * @return string|null Id of the widget.
     */
    public function getId(): ?string
    {
        if ($this->autoGenerate && $this->id === null) {
            $this->id = $this->autoIdPrefix . static::$counter++;
        }

        return $this->id;
    }

    /**
     * Set the Id of the widget.
     *
     * @param string $value
     *
     * @return self
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;

        return $new;
    }

    /**
     * Counter used to generate {@see id} for widgets.
     *
     * @param int $value
     */
    public static function counter(int $value): void
    {
        self::$counter = $value;
    }

    /**
     * The prefix to the automatically generated widget IDs.
     *
     * @param string $value
     *
     * @return self
     *
     * {@see getId()}
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;

        return $new;
    }

    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return $this
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;

        return $new;
    }
}
