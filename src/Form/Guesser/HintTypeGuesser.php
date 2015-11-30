<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\VariableTypeToFormTypeMapper;
use Symfony\Component\Form\FormTypeGuesserInterface;

class HintTypeGuesser implements FormTypeGuesserInterface
{
    /** @var TypeGuessFactory */
    private $factory;
    /** @var VariableTypeToFormTypeMapper */
    private $mapper;

    /**
     * @param VariableTypeToFormTypeMapper $mapper
     * @param TypeGuessFactory             $factory
     */
    public function __construct(VariableTypeToFormTypeMapper $mapper, TypeGuessFactory $factory)
    {
        $this->factory = $factory;
        $this->mapper  = $mapper;
    }

    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        $propertyType = $this->readVariableType($class, $property);

        if (null === $propertyType) {
            return;
        }

        $formType = $this->mapper->getFormType($propertyType);

        if (null === $formType) {
            return;
        }

        return $this->factory->create($formType);
    }

    /** {@inheritdoc} */
    public function guessRequired($class, $property)
    {
    }

    /** {@inheritdoc} */
    public function guessMaxLength($class, $property)
    {
    }

    /** {@inheritdoc} */
    public function guessPattern($class, $property)
    {
    }

    /** {@inheritdoc} */
    protected function readVariableType($class, $property)
    {
        $reflectionClass = new \ReflectionClass($class);
        $constructor     = $reflectionClass->getConstructor();

        foreach ($constructor->getParameters() as $parameter) {
            if ($parameter->name == $property && null !== $parameter->getClass()) {
                return $parameter->getClass()->name;
            }
        }
    }
}
