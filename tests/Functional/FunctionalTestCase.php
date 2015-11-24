<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Form\Extension\NotBlankExtension;
use Lucaszz\SymfonyGenericForm\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyGenericForm\Form\Type\DateTimeType;
use Lucaszz\SymfonyGenericForm\Form\Type\UuidType;
use Lucaszz\SymfonyGenericForm\Generator;
use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Lucaszz\SymfonyGenericForm\Tests\UnitTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

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
            ->addTypeGuessers($this->getTypeGuessers())
            ->addExtensions($this->getExtensions())
            ->addTypeExtensions($this->getTypeExtensions())
            ->addTypes($this->getTypes())
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

    private function getExtensions()
    {
        $validation = Validation::createValidatorBuilder();
        $validator  = $validation->getValidator();

        return [new ValidatorExtension($validator)];
    }

    private function getTypeExtensions()
    {
        return [new NotBlankExtension()];
    }

    private function getTypes()
    {
        return [new DateTimeType(), new UuidType()];
    }
}
