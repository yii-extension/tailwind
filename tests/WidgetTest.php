<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use PHPUnit\Framework\TestCase;
use Yii\Extension\Tailwind\Tests\TestSupport\StubWidget;
use Yii\Extension\Tailwind\Tests\TestSupport\TestTrait;

final class WidgetTest extends TestCase
{
    use TestTrait;

    public function testAutoIdPrefix(): void
    {
        StubWidget::counter(0);

        $this->assertSame('<run-t0>', StubWidget::widget()->autoIdPrefix('t')->render());
    }

    public function testGetId(): void
    {
        StubWidget::counter(0);

        $this->assertSame('<run-w0>', StubWidget::widget()->render());
    }

    public function testId(): void
    {
        StubWidget::counter(0);

        $this->assertSame('<run-test-2>', StubWidget::widget()->id('test-2')->render());
    }

}
