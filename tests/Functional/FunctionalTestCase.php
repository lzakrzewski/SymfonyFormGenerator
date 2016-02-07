<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Functional;

use Lzakrzewski\SymfonyFormGenerator\Generator;
use Lzakrzewski\SymfonyFormGenerator\GeneratorFactory;
use Lzakrzewski\SymfonyFormGenerator\Tests\UnitTestCase;

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
