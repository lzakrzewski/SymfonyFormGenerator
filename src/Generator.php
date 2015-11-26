<?php

namespace Lucaszz\SymfonyGenericForm;

use Lucaszz\SymfonyGenericForm\Form\Type\GenericFormType;
use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

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
     * @todo Probably this method should return form builder
     *
     * @param $class
     *
     * @throws \InvalidArgumentException
     *
     * @return FormInterface
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

        return $builder->getForm();
    }

    private function emptyBuilder($class)
    {
        return $this->builder->create('form', new GenericFormType($class));
    }
}
