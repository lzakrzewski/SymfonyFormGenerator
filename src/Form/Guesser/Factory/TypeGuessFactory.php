<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory;

use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class TypeGuessFactory
{
    /**
     * @param $formType
     *
     * @return TypeGuess
     */
    public function create($formType)
    {
        if ($formType == 'text') {
            return new TypeGuess($formType, [], Guess::HIGH_CONFIDENCE);
        }

        if ($formType == 'integer') {
            return new TypeGuess($formType, [], Guess::MEDIUM_CONFIDENCE);
        }

        if ($formType == 'number') {
            return new TypeGuess($formType, [], Guess::MEDIUM_CONFIDENCE);
        }

        if ($formType == 'checkbox') {
            return new TypeGuess($formType, [], Guess::HIGH_CONFIDENCE);
        }

        if (false !== strpos($formType, 'generator_')) {
            return new TypeGuess($formType, [], Guess::HIGH_CONFIDENCE);
        }

        return new TypeGuess($formType, [], Guess::LOW_CONFIDENCE);
    }
}
