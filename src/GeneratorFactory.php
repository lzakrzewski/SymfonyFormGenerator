<?php

namespace Lucaszz\SymfonyFormGenerator;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Form\Extension\Core\FormGeneratorExtension;
use Lucaszz\SymfonyFormGenerator\Property\PropertyNamesReader;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

final class GeneratorFactory
{
    private function __construct()
    {
    }

    public static function createGenerator()
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping(new AnnotationReader());
        $validator  = $validation->getValidator();

        $formFactoryExtension = new FormGeneratorExtension();
        $validatorExtension   = new ValidatorExtension($validator);

        $factory = Forms::createFormFactoryBuilder()
            ->addExtension($formFactoryExtension)
            ->addExtension($validatorExtension)
            ->getFormFactory();

        return new Generator($factory, new PropertyNamesReader());
    }
}
