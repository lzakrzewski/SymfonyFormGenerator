<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Doctrine\Common\Annotations\AnnotationReader;
use Lucaszz\SymfonyFormGenerator\Annotation\Form\Field;

class FormAnnotationGuesser implements FormTypeGuesser
{
    /** {@inheritdoc} */
    public function guess($class, $property)
    {
        $field = $this->fieldAnnotation($class, $property);

        if (null === $field) {
            return;
        }

        return new Guess($field->type, $field->options);
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
