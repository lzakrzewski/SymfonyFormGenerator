<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnConstructorParams
{
    public $propertyInteger;
    public $propertyNumber;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
    public $propertyMoney;

    /**
     * @param int           $propertyInteger
     * @param float         $propertyNumber
     * @param string        $propertyString
     * @param \DateTime     $propertyDateTime
     * @param UuidInterface $propertyUuid
     * @param Money         $propertyMoney
     */
    public function __construct($propertyInteger, $propertyNumber, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyNumber   = $propertyNumber;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
