<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithTypeHinting
{
    public $propertyBoolean;
    public $propertyArray;
    public $propertyInteger;
    public $propertyNumber;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
    public $propertyMoney;

    public function __construct($propertyBoolean, array $propertyArray, $propertyInteger, $propertyNumber, $propertyString, \DateTime $propertyDateTime, UuidInterface $propertyUuid, Money $propertyMoney)
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
