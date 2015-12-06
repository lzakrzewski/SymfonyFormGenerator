<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

interface FormTypeGuesser
{
    /**
     * @param $class
     * @param $property
     *
     * @return Guess|null
     */
    public function guess($class, $property);
}
