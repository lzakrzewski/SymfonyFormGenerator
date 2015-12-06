<?php

namespace Lucaszz\SymfonyFormGenerator\Form;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Form\Extension\Core\FormGeneratorExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\Form\FormFactoryBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validation;

/**
 * @deprecated
 */
final class Forms
{
    /**
     * Creates a form factory with the default configuration.
     *
     * @return FormFactoryInterface The form factory.
     */
    public static function createFormFactory()
    {
        return self::createFormFactoryBuilder()->getFormFactory();
    }

    /**
     * Creates a form factory builder with the default configuration.
     *
     * @return FormFactoryBuilderInterface The form factory builder.
     */
    public static function createFormFactoryBuilder()
    {
        $builder = new FormFactoryBuilder();
        $builder->addExtension(new FormGeneratorExtension())
            ->addExtensions(self::getExtensions());

        return $builder;
    }

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }

    private static function getExtensions()
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping(new AnnotationReader());
        $validator  = $validation->getValidator();

        return [new ValidatorExtension($validator)];
    }
}
