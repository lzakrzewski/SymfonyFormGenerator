<?php

namespace Lzakrzewski\SymfonyFormGenerator\Guesser;

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
