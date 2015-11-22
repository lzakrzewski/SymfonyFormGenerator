<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyGenericForm\Generator;
use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;

abstract class FormTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var Generator */
    protected $generator;
    /** @var FormBuilderInterface */
    private $builder;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $factory = Forms::createFormFactoryBuilder()
            ->addTypeGuessers($this->getTypeGuessers())
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

    private function getTypeGuessers()
    {
        $resolver = new TypeGuessResolver();

        return [
            new PHPDocTypeGuesser($resolver),
            new HintTypeGuesser($resolver),
        ];
    }
}
