<?php

namespace Lucaszz\SymfonyFormGenerator;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\PropertyTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Form\Type\GeneratorFormType;
use Lucaszz\SymfonyFormGenerator\Guesser\ChainGuesser;
use Lucaszz\SymfonyFormGenerator\Guesser\FormAnnotationGuesser;
use Lucaszz\SymfonyFormGenerator\Guesser\PHPDocGuesser;
use Lucaszz\SymfonyFormGenerator\Guesser\TypeHintGuesser;
use Lucaszz\SymfonyFormGenerator\Guesser\ValidatorGuesser;
use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validation;

class Generator
{
    /** @var FormBuilderInterface */
    private $builder;
    /** @var PropertyNamesReader */
    private $propertyNames;

    /**
     * @param FormFactoryInterface $factory
     * @param PropertyNamesReader  $propertyNames
     */
    public function __construct(FormFactoryInterface $factory, PropertyNamesReader $propertyNames)
    {
        $this->builder       = $factory->createBuilder();
        $this->propertyNames = $propertyNames;
    }

    /**
     * @param $class
     *
     * @throws \InvalidArgumentException
     *
     * @return FormBuilderInterface
     */
    public function generateFormBuilder($class)
    {
        if (!is_string($class) || !class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Form could be generated only from valid class names, %s given.', gettype($class)));
        }

        $builder = $this->emptyBuilder($class);
        $guesser = $this->chainGuesser();

        foreach ($this->propertyNames->read($class) as $propertyName) {
            $guess = $guesser->guess($class, $propertyName);

            $builder = $builder->add($propertyName, $guess->getFormType(), $guess->getOptions());
        }

        return $builder;
    }

    /**
     * @todo extract it to parameter
     */
    private function chainGuesser()
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping(new AnnotationReader());
        $validator  = $validation->getValidator();

        $mapper = PropertyTypeToFormTypeMapper::withDefaultMappings();

        $chainGuesser          = new ChainGuesser();
        $formAnnotationGuesser = new FormAnnotationGuesser();
        $typeHintGuesser       = new TypeHintGuesser($mapper);
        $validatorGuesser      = new ValidatorGuesser($mapper, new ValidatorTypeGuesser($validator->getMetadataFactory()));
        $phpDocGuesser         = new PHPDocGuesser($mapper);

        $chainGuesser->add($formAnnotationGuesser, 100);
        $chainGuesser->add($typeHintGuesser, 80);
        $chainGuesser->add($phpDocGuesser, 70);
        $chainGuesser->add($validatorGuesser, 60);

        return $chainGuesser;
    }

    private function emptyBuilder($class)
    {
        return $this->builder->create('form', new GeneratorFormType($class));
    }
}
