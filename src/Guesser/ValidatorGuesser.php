<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser;
use Symfony\Component\Form\Guess\TypeGuess as SymfonyGuess;

class ValidatorGuesser implements FormTypeGuesser
{
    /** @var ValidatorTypeGuesser */
    private $symfonyGuesser;
    /** @var PropertyTypeToFormTypeMapper */
    private $mapper;

    /**
     * @param PropertyTypeToFormTypeMapper $mapper
     * @param ValidatorTypeGuesser         $symfonyGuesser
     */
    public function __construct(PropertyTypeToFormTypeMapper $mapper, ValidatorTypeGuesser $symfonyGuesser)
    {
        $this->mapper         = $mapper;
        $this->symfonyGuesser = $symfonyGuesser;
    }

    /** {@inheritdoc} */
    public function guess($class, $property)
    {
        $symfonyGuess = $this->symfonyGuesser->guessType($class, $property);

        if (null !== $symfonyGuess) {
            return $this->transformGuess($symfonyGuess);
        }
    }

    private function transformGuess(SymfonyGuess $symfonyGuess)
    {
        $formType = $symfonyGuess->getType();

        if ($formType == 'datetime') {
            $formType = 'generator_datetime';
        }

        return Guess::withDefaultOptions($formType);
    }
}
