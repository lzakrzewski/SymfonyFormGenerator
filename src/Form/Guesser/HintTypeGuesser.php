<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
use Symfony\Component\Form\FormTypeGuesserInterface;

class HintTypeGuesser implements FormTypeGuesserInterface
{
    /** @var TypeGuessResolver */
    private $resolver;

    /**
     * @param TypeGuessResolver $resolver
     */
    public function __construct(TypeGuessResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        $propertyType = $this->readPropertyType($class, $property);

        if (null === $propertyType) {
            return;
        }

        return $this->resolver->resolve($propertyType);
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
    protected function readPropertyType($class, $property)
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
