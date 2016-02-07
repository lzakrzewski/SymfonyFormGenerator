<?php

namespace Lzakrzewski\SymfonyFormGenerator\Guesser;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

final class Guess
{
    /** @var array */
    private $equivalentMap = [
        [
            'symfonyType'  => 'datetime',
            'symfonyClass' => DateTimeType::class,
            'equivalent'   => 'generator_datetime',
        ],
        [
            'symfonyType'  => 'text',
            'symfonyClass' => TextType::class,
            'equivalent'   => 'generator_string',
        ],
        [
            'symfonyType'  => 'collection',
            'symfonyClass' => CollectionType::class,
            'equivalent'   => 'generator_array',
        ],
    ];

    /** @var string */
    private $formType;
    /** @var array */
    private $options;

    public function __construct($formType, $options)
    {
        if (null !== $equivalent = $this->equivalent($formType)) {
            $formType = $equivalent;
        }

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

    private function equivalent($formType)
    {
        foreach ($this->equivalentMap as $map) {
            if ($formType == $map['symfonyType']) {
                return $map['equivalent'];
            }

            $symfonyClass = $map['symfonyClass'];

            if ($formType instanceof $symfonyClass) {
                return $map['equivalent'];
            }

            if ($formType == $symfonyClass) {
                return $map['equivalent'];
            }
        }
    }
}
