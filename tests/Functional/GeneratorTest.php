<?php

namespace Lucaszz\SymfonyGenericFormType\Tests;

use Lucaszz\SymfonyGenericFormType\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Generator */
    private $generator;

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_type_for_non_objects()
    {
        $this->generator->generate([1, 2, 3, 4]);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->generator = new Generator();
    }

    /** {@inheritdoc} */
    public function tearDown()
    {
        $this->generator = null;
    }
}
