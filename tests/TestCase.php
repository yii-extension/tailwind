<?php

declare(strict_types=1);

namespace Yii\Extension\Tailwind\Tests;

use PHPUnit\Framework\TestCase as AbstractTestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends AbstractTestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();
        WidgetFactory::initialize($this->container, []);
    }

    protected function tearDown(): void
    {
        unset($this->container);

        parent::tearDown();
    }

    /**
     * Asserting two strings equality ignoring line endings.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        self::assertEquals($expected, $actual, $message);
    }
}
