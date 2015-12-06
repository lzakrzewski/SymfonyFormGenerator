<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Type;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Form\Extension\Core\FormGeneratorExtension;
use Lucaszz\SymfonyFormGenerator\Tests\UnitTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

abstract class FormTypeTestCase extends UnitTestCase
{
    /** @var FormFactoryInterface */
    protected $factory;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping(new AnnotationReader());
        $validator  = $validation->getValidator();

        $formFactoryExtension = new FormGeneratorExtension();
        $validatorExtension   = new ValidatorExtension($validator);

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtension($formFactoryExtension)
            ->addExtension($validatorExtension)
            ->getFormFactory();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->factory = null;
    }
}
