<?php

namespace Lucaszz\SymfonyGenericFormType\Tests;

use Lucaszz\SymfonyGenericFormType\SomeClass;

class SomeTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_has_name()
    {
        $this->assertEquals(SomeClass::class, (new SomeClass())->getMyName());
    }
}
