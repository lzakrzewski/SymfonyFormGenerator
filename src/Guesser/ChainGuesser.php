<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

class ChainGuesser implements FormTypeGuesser
{
    /** @var FormTypeGuesser[]|\SplPriorityQueue  */
    private $guessers;

    public function __construct()
    {
        $this->guessers = new \SplPriorityQueue();
    }

    /** {@inheritdoc} */
    public function guess($class, $property)
    {
        foreach (clone $this->guessers as $guesser) {
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
        return Guess::withDefaultOptions('text');
    }
}
