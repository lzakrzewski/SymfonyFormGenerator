<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\fixtures;

use Symfony\Component\Validator\Constraints as Assert;

class ObjectWithAssertAnnotations
{
    /**
     * @Assert\IsTrue
     */
    public $propertyBoolean;
    /**
     * @Assert\Count(max="5")
     */
    public $propertyArray;

    /**
     * @Assert\Range(min="0", max="10")
     */
    public $propertyInteger;
    /**
     * @Assert\Range(min="0", max="10")
     */
    public $propertyNumber;
    /**
     * @Assert\Length(min="0", max="5")
     */
    public $propertyString;
    /**
     * @Assert\DateTime
     */
    public $propertyDateTime;
    /**
     * @Assert\NotNull
     */
    public $propertyUuid;
    /**
     * @Assert\NotNull
     */
    public $propertyMoney;

    public function __construct($propertyBoolean, $propertyArray, $propertyInteger, $propertyNumber, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
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
