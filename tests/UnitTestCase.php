<?php

namespace Lucaszz\SymfonyGenericForm\Tests;

use Ramsey\Uuid\Uuid;

class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    protected function assertDateTimeEquals(\DateTime $expected, $actual)
    {
        $this->assertInstanceOf(\DateTime::class, $actual);
        $this->assertEquals($expected->format('c'), $actual->format('c'));
    }

    protected function assertUuidEquals(Uuid $expected, $actual)
    {
        $this->assertInstanceOf(Uuid::class, $actual);
        $this->assertEquals($expected->toString(), $actual->toString());
    }
}
