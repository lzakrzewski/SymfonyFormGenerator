<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Form\Extension\NotBlankExtension;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\FormAnnotationTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyFormGenerator\Form\Type\DateTimeType;
use Lucaszz\SymfonyFormGenerator\Form\Type\MoneyType;
use Lucaszz\SymfonyFormGenerator\Form\Type\UuidType;
use Lucaszz\SymfonyFormGenerator\Generator;
use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Lucaszz\SymfonyFormGenerator\Tests\UnitTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

/**
 * @todo introduce custom FORMS
 */
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
            new FormAnnotationTypeGuesser($resolver),
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
        return [new DateTimeType(), new UuidType(), new MoneyType()];
    }
}
