<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Form\Forms;
use Lucaszz\SymfonyFormGenerator\Generator;
use Lucaszz\SymfonyFormGenerator\Property\PropertyNamesReader;
use Lucaszz\SymfonyFormGenerator\Tests\UnitTestCase;

abstract class FunctionalTestCase extends UnitTestCase
{
    /** @var Generator */
    protected $generator;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $factory = Forms::createFormFactoryBuilder()
            ->getFormFactory();

        $this->generator = new Generator($factory, new PropertyNamesReader());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->generator = null;
    }
}
