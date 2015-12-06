<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Generator;
use Lucaszz\SymfonyFormGenerator\GeneratorFactory;
use Lucaszz\SymfonyFormGenerator\Tests\UnitTestCase;

abstract class FunctionalTestCase extends UnitTestCase
{
    /** @var Generator */
    protected $generator;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->generator = GeneratorFactory::createGenerator();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->generator = null;
    }
}
