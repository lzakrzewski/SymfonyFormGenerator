<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Annotation\Form\Field;
use Symfony\Component\Form\FormTypeGuesserInterface;
use Symfony\Component\Form\Guess\TypeGuess;

class FormAnnotationTypeGuesser implements FormTypeGuesserInterface
{
    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        $field = $this->fieldAnnotation($class, $property);

        if (null === $field) {
            return;
        }

        return new TypeGuess($field->type, $field->options, TypeGuess::HIGH_CONFIDENCE);
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

    private function fieldAnnotation($class, $property)
    {
        $reflectionClass = new \ReflectionClass($class);
        $property        = $reflectionClass->getProperty($property);

        $reader = new AnnotationReader();

        $annotations = $reader->getPropertyAnnotations($property);

        foreach ($annotations as $annotation) {
            if ($annotation instanceof Field) {
                return $annotation;
            }
        }
    }
}
