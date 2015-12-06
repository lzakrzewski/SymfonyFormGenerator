<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

/**
 * @todo add default static constructor
 */
final class Guess
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
