<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;

class TypeHintGuesser implements FormTypeGuesser
{
    /** @var PropertyTypeToFormTypeMapper */
    private $mapper;

    /**
     * @param PropertyTypeToFormTypeMapper $mapper
     */
    public function __construct(PropertyTypeToFormTypeMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /** {@inheritdoc} */
    public function guess($class, $property)
    {
        $propertyType = $this->readVariableType($class, $property);

        if (null === $propertyType) {
            return;
        }

        $formType = $this->mapper->getFormType($propertyType);

        if (null === $formType) {
            return;
        }

        return Guess::withDefaultOptions($formType);
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

            if ($parameter->name == $property && $parameter->isArray()) {
                return 'array';
            }
        }
    }
}
