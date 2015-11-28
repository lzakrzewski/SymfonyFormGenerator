<?php

namespace Lucaszz\SymfonyFormGenerator;

use Lucaszz\SymfonyFormGenerator\Form\Type\GenericFormType;
use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Symfony\Component\Form\FormBuilderInterface;

class Generator
{
    /** @var FormBuilderInterface */
    private $builder;
    /** @var PropertyNamesReader */
    private $propertyNames;

    /**
     * @param FormBuilderInterface $builder
     * @param PropertyNamesReader  $propertyNames
     */
    public function __construct(FormBuilderInterface $builder, PropertyNamesReader $propertyNames)
    {
        $this->builder       = $builder;
        $this->propertyNames = $propertyNames;
    }

    /**
     * @param $class
     *
     * @throws \InvalidArgumentException
     *
     * @return FormBuilderInterface
     */
    public function generate($class)
    {
        if (!is_string($class) || !class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Form could be generated only from valid class names, %s given.', gettype($class)));
        }

        $builder = $this->emptyBuilder($class);

        foreach ($this->propertyNames->read($class) as $propertyName) {
            $builder = $builder->add($propertyName, null);
        }

        return $builder;
    }

    private function emptyBuilder($class)
    {
        return $this->builder->create('form', new GenericFormType($class));
    }
}
