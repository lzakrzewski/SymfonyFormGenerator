<?php

namespace Lzakrzewski\SymfonyFormGenerator;

use Doctrine\Common\Annotations\AnnotationReader;
use Lzakrzewski\SymfonyFormGenerator\Form\Extension\Core\FormGeneratorExtension;
use Lzakrzewski\SymfonyFormGenerator\Guesser\ChainGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\FormAnnotationGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\PHPDocGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\TypeHintGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\ValidatorGuesser;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyNamesReader;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

final class GeneratorFactory
{
    private function __construct()
    {
    }

    /**
     * @param PropertyTypeToFormTypeMapper|null $mapper
     *
     * @return Generator
     */
    public static function createGenerator(PropertyTypeToFormTypeMapper $mapper = null)
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping(new AnnotationReader());
        $validator  = $validation->getValidator();

        $formFactoryExtension = new FormGeneratorExtension();
        $validatorExtension   = new ValidatorExtension($validator);

        $factory = Forms::createFormFactoryBuilder()
            ->addExtension($formFactoryExtension)
            ->addExtension($validatorExtension)
            ->getFormFactory();

        $mapper = $mapper ?: PropertyTypeToFormTypeMapper::withDefaultMappings();

        $chainGuesser          = new ChainGuesser();
        $formAnnotationGuesser = new FormAnnotationGuesser();
        $typeHintGuesser       = new TypeHintGuesser($mapper);
        $validatorGuesser      = new ValidatorGuesser($mapper, new ValidatorTypeGuesser($validator->getMetadataFactory()));
        $phpDocGuesser         = new PHPDocGuesser($mapper);

        $chainGuesser->add($formAnnotationGuesser, 100);
        $chainGuesser->add($typeHintGuesser, 80);
        $chainGuesser->add($phpDocGuesser, 70);
        $chainGuesser->add($validatorGuesser, 60);

        return new Generator($factory, new PropertyNamesReader(), $chainGuesser);
    }
}
