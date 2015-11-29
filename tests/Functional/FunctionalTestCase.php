<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Form\Forms;
use Lucaszz\SymfonyFormGenerator\Generator;
use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Lucaszz\SymfonyFormGenerator\Tests\UnitTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

abstract class FunctionalTestCase extends UnitTestCase
{
    /** @var Generator */
    protected $generator;
    /** @var FormBuilderInterface */
    private $builder;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $factory = Forms::createFormFactoryBuilder()
            ->getFormFactory();

        $dispatcher = $this->prophesize(EventDispatcherInterface::class);

        $this->builder   = new FormBuilder(null, null, $dispatcher->reveal(), $factory);
        $this->generator = new Generator($this->builder, new PropertyNamesReader());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->builder   = null;
        $this->generator = null;
    }
}
