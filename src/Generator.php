<?php

namespace Lzakrzewski\SymfonyFormGenerator;

use Lzakrzewski\SymfonyFormGenerator\Form\Type\GeneratorFormType;
use Lzakrzewski\SymfonyFormGenerator\Guesser\FormTypeGuesser;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyNamesReader;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

class Generator
{
    /** @var FormBuilderInterface */
    private $builder;
    /** @var PropertyNamesReader */
    private $propertyNames;
    /** @var FormTypeGuesser */
    private $guesser;

    /**
     * @param FormFactoryInterface $factory
     * @param PropertyNamesReader  $propertyNames
     * @param FormTypeGuesser      $guesser
     */
    public function __construct(FormFactoryInterface $factory, PropertyNamesReader $propertyNames, FormTypeGuesser $guesser)
    {
        $this->builder       = $factory->createBuilder();
        $this->propertyNames = $propertyNames;
        $this->guesser       = $guesser;
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

        foreach ($this->propertyNames->read($class) as $propertyName) {
            $guess   = $this->guesser->guess($class, $propertyName);
            $builder = $builder->add($propertyName, $guess->getFormType(), $guess->getOptions());
        }

        return $builder;
    }

    private function emptyBuilder($class)
    {
        return $this->builder->create('form', new GeneratorFormType($class));
    }
}
