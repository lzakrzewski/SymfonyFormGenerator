<?php

namespace Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver;

use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

/**
 * @todo introduce config class
 * read full namespace
 */
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
                return new TypeGuess('generic_datetime', [], Guess::HIGH_CONFIDENCE);

            case '\UuidInterface':
            case '\Uuid':
            case 'UuidInterface':
            case 'Uuid':
            case '\Ramsey\Uuid\Uuid':
            case '\Ramsey\Uuid\UuidInterface':
            case 'Ramsey\Uuid\Uuid':
            case 'Ramsey\Uuid\UuidInterface':
                return new TypeGuess('generic_uuid', [], Guess::HIGH_CONFIDENCE);

            case '\Money\Money':
            case 'Money\Money':
            case '\Money':
            case 'Money':
                return new TypeGuess('generic_money', [], Guess::HIGH_CONFIDENCE);

            default:
                return new TypeGuess('text', [], Guess::LOW_CONFIDENCE);
        }
    }
}
