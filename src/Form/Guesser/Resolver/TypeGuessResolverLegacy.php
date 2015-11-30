<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver;

use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

/**
 * @todo introduce config class
 * @todo: Word for config "mapper", "rule" could be great
 *
 * @deprecated
 * read full namespace, how about class for this ?
 */
class TypeGuessResolverLegacy
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
                return new TypeGuess('generator_datetime', [], Guess::HIGH_CONFIDENCE);

            case '\UuidInterface':
            case '\Uuid':
            case 'UuidInterface':
            case 'Uuid':
            case '\Ramsey\Uuid\Uuid':
            case '\Ramsey\Uuid\UuidInterface':
            case 'Ramsey\Uuid\Uuid':
            case 'Ramsey\Uuid\UuidInterface':
                return new TypeGuess('generator_uuid', [], Guess::HIGH_CONFIDENCE);

            case '\Money\Money':
            case 'Money\Money':
            case '\Money':
            case 'Money':
                return new TypeGuess('generator_money', [], Guess::HIGH_CONFIDENCE);

            default:
                return new TypeGuess('text', [], Guess::LOW_CONFIDENCE);
        }
    }
}
