<?php

namespace Lucaszz\SymfonyGenericForm\Tests;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    protected function money($amount)
    {
        return new Money($amount, new Currency('USD'));
    }

    protected function assertMoneyEquals(Money $expected, $actual)
    {
        $this->assertInstanceOf(Money::class, $actual);
        $this->assertTrue($expected->equals($actual));
    }

    protected function assertDateTimeEquals(\DateTime $expected, $actual)
    {
        $this->assertInstanceOf(\DateTime::class, $actual);
        $this->assertEquals($expected->format('c'), $actual->format('c'));
    }

    protected function assertUuidEquals(Uuid $expected, $actual)
    {
        $this->assertInstanceOf(Uuid::class, $actual);
        $this->assertTrue($expected->equals($actual));
    }
}
