<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind;

use Yii\Extension\Simple\Widget\AbstractWidget;

abstract class Widget extends AbstractWidget
{
    private array $attributes = [];
    private ?string $id = null;
    private bool $autoGenerate = true;
    private string $autoIdPrefix = 'w';
    private static int $counter = 0;

    /**
     * The HTML attributes for the navbar. The following special options are recognized.
     *
     * @param array $value
     *
     * @return static
     */
    public function attributes(array $value): self
    {
        $new = clone $this;
        $new->attributes = $value;
        return $new;
    }

    /**
     * The prefix to the automatically generated widget IDs.
     *
     * @param string $value
     *
     * @return static
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
     * Set the Id of the widget.
     *
     * @param string $value
     *
     * @return static
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

    protected function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Returns the Id of the widget.
     *
     * @return string|null Id of the widget.
     */
    protected function getId(): ?string
    {
        if ($this->autoGenerate && $this->id === null) {
            $this->id = $this->autoIdPrefix . static::$counter++;
        }

        return $this->id;
    }
}
