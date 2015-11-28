<?php

namespace Lucaszz\SymfonyFormGenerator\Tests;

use Money\Money;
use Ramsey\Uuid\Uuid;

class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    protected function assertMoneyEquals(Money $expected, $actual)
    {
        $this->assertInstanceOf(Money::class, $actual);
        $this->assertTrue(
            $expected->equals($actual),
            sprintf(
                'Given Money %s %s is not equal to %s %s',
                $actual->getAmount(),
                $actual->getCurrency(),
                $expected->getAmount(),
                $expected->getCurrency()
            )
        );
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
