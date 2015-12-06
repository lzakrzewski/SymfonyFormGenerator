<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Symfony\Component\Validator\Constraints\NotBlank;

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

    /**
     * @param $formType
     *
     * @return Guess
     */
    public static function withDefaultOptions($formType)
    {
        return new self($formType, ['constraints' => new NotBlank()]);
    }
}
