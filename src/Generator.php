<?php

namespace Lucaszz\SymfonyFormGenerator;

use Lucaszz\SymfonyFormGenerator\Form\Type\GeneratorFormType;
use Lucaszz\SymfonyFormGenerator\Reader\PropertyNamesReader;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

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

        foreach ($this->propertyNames->read($class) as $propertyName) {
            $builder = $builder->add($propertyName, null, ['constraints' => [new NotBlank()]]);
        }

        return $builder;
    }

    private function emptyBuilder($class)
    {
        return $this->builder->create('form', new GeneratorFormType($class));
    }
}
