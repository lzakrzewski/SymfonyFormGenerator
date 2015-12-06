<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChainGuesser implements FormTypeGuesser
{
    /** @var FormTypeGuesser[]|\SplPriorityQueue  */
    private $guessers;

    public function __construct()
    {
        $this->guessers = new \SplPriorityQueue();
    }

    /**
     * @param $class
     * @param $property
     *
     * @return FormTypeInterface|null
     */
    public function guess($class, $property)
    {
        foreach ($this->guessers as $guesser) {
            if (null !== $guess = $guesser->guess($class, $property)) {
                return $guess;
            }
        }

        return $this->defaultGuess();
    }

    /**
     * @param FormTypeGuesser $guesser
     * @param $priority
     */
    public function add(FormTypeGuesser $guesser, $priority)
    {
        $this->guessers->insert($guesser, $priority);
    }

    private function defaultGuess()
    {
        return new Guess('text', ['constraints' => new NotBlank()]);
    }
}
