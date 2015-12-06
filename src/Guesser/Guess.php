<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

class Guess
{
    /** @var string */
    private $formType;
    /** @var array */
    private $options;

    public function __construct($formType, $options)
    {
        $this->formType = $formType;
        $this->options  = $options;
    }
}
