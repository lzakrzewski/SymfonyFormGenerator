<?php

namespace Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver;

use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class TypeGuessResolver
{
    /**
     * @param $propertyType
     *
     * @return TypeGuess
     */
    public function resolve($propertyType)
    {
        switch ($propertyType) {
            case 'string':
                return new TypeGuess('text', [], Guess::HIGH_CONFIDENCE);

            case 'int':
            case 'integer':
                return new TypeGuess('integer', [], Guess::MEDIUM_CONFIDENCE);

            case 'float':
            case 'double':
            case 'real':
                return new TypeGuess('number', [], Guess::MEDIUM_CONFIDENCE);

            case 'boolean':
            case 'bool':
                return new TypeGuess('checkbox', [], Guess::HIGH_CONFIDENCE);

            case '\DateTime':
            case 'DateTime':
                return new TypeGuess('datetime', [], Guess::HIGH_CONFIDENCE);

            default:
                return new TypeGuess('text', [], Guess::LOW_CONFIDENCE);
        }
    }
}
