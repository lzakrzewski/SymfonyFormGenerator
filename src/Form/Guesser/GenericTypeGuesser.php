<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
use Symfony\Component\Form\FormTypeGuesserInterface;

/**
 * @todo rename to variable type guesser ?
 */
abstract class GenericTypeGuesser implements FormTypeGuesserInterface
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

    /**
     * @param $class
     * @param $property
     *
     * @return string
     */
    abstract protected function readPropertyType($class, $property);
}
