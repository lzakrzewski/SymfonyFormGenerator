<?php

namespace Lucaszz\SymfonyGenericForm\Form\Guesser;

class HintTypeGuesser extends GenericTypeGuesser
{
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
