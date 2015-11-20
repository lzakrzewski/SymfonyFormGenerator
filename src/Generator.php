<?php

namespace Lucaszz\SymfonyGenericForm;

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
     * @param $object
     *
     * @throws \InvalidArgumentException
     *
     * @return FormInterface
     */
    public function generate($object)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException(sprintf('Unable to generate form type from non-object, %s given.', gettype($object)));
        }

        $builder = $this->emptyBuilder($object);

        foreach ($this->propertyNames->read($object) as $propertyName) {
            $builder = $builder->add($propertyName, null);
        }

        return $builder->getForm();
    }

    private function emptyBuilder($object)
    {
        return $this->builder->create('form', null, ['compound' => true, 'data_class' => get_class($object)]);
    }
}
