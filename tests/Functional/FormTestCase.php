<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormTypeGuesserInterface;

abstract class FormTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var FormBuilderInterface */
    protected $builder;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $factory = Forms::createFormFactoryBuilder()
            ->addTypeGuessers($this->getTypeGuessers())
            ->getFormFactory();

        $dispatcher = $this->prophesize(EventDispatcherInterface::class);

        $this->builder = new FormBuilder(null, null, $dispatcher->reveal(), $factory);
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->builder = null;
    }

    protected function assertThatFormFieldHasType($expectedType, $fieldName, FormInterface $form)
    {
        $name = $form->get($fieldName)->getConfig()->getType()->getName();

        $this->assertEquals($expectedType, $name);
    }

    /**
     * @return FormTypeGuesserInterface[]
     */
    abstract protected function getTypeGuessers();
}
