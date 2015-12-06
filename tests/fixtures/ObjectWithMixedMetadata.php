<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Lucaszz\SymfonyFormGenerator\Annotation\Form;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

class ObjectWithMixedMetadata
{
    /**
     * @var bool
     * @Assert\Length(min="0", max="255")
     */
    public $propertyBoolean;

    /**
     * @var string
     * @Assert\Count(max="5")
     */
    public $propertyArray;

    /**
     * Expected: integer.
     *
     * @var string
     * @Assert\Length(min="0", max="255")
     * @Form\Field("integer", options={"label"="Property Integer"})
     */
    public $propertyInteger;

    /**
     * Expected: float.
     *
     * @var float
     * @Assert\Length(min="0", max="255")
     */
    public $propertyNumber;

    /**
     * Expected string.
     *
     * @var int
     * @Form\Field("generator_string", options={"label"="Property String"})
     */
    public $propertyString;

    /**
     * Expected: DateTime.
     *
     * @Assert\NotNull
     *
     * @var \DateTime
     */
    public $propertyDateTime;

    /**
     * Expected: UuidInterface.
     *
     * @Assert\Length(min="0", max="255")
     * @Form\Field("generator_uuid", options={"label"="Property Uuid"})
     *
     * @var string
     */
    public $propertyUuid;

    /**
     * Expected: Money.
     *
     * @var \DateTime
     */
    public $propertyMoney;

    public function __construct($propertyBoolean, $propertyArray, $propertyInteger, $propertyNumber, $propertyString, $propertyDateTime, $propertyUuid, Money $propertyMoney)
    {
        $this->propertyBoolean  = $propertyBoolean;
        $this->propertyArray    = $propertyArray;
        $this->propertyInteger  = $propertyInteger;
        $this->propertyNumber   = $propertyNumber;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
