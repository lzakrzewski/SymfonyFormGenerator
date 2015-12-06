<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

final class Guess
{
    /** @var string */
    private $formType;
    /** @var array */
    private $options;

    public function __construct($formType, $options)
    {
        $formType = $this->convertFormType($formType);

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

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    private function convertFormType($formType)
    {
        if ($formType instanceof DateTimeType) {
            return 'generator_datetime';
        }

        if ($formType == DateTimeType::class) {
            return 'generator_datetime';
        }

        if ($formType == 'datetime') {
            return 'generator_datetime';
        }

        return $formType;
    }
}
