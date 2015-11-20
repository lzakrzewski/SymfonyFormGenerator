<?php

namespace Lucaszz\SymfonyGenericForm\Guesser;

use Symfony\Component\Form\FormTypeGuesserInterface;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class PHPDocTypeGuesser implements FormTypeGuesserInterface
{
    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        if ($class != 'Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadata') {
            return;
        }

        if ($property == 'propertyInteger') {
            return new TypeGuess('integer', [], Guess::MEDIUM_CONFIDENCE);
        }

        if ($property == 'propertyString') {
            return new TypeGuess('text', [], Guess::MEDIUM_CONFIDENCE);
        }

        if ($property == 'propertyDateTime') {
            return new TypeGuess('datetime', [], Guess::MEDIUM_CONFIDENCE);
        }

        if ($property == 'propertyUuid') {
            return new TypeGuess('text', [], Guess::MEDIUM_CONFIDENCE);
        }
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

    protected function readPhpDocAnnotations($class, $property)
    {
    }
}
