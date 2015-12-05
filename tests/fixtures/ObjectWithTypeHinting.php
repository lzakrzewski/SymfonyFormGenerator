<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithTypeHinting
{
    public $propertyInteger;
    public $propertyNumber;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
    public $propertyMoney;

    public function __construct($propertyInteger, $propertyNumber, $propertyString, \DateTime $propertyDateTime, UuidInterface $propertyUuid, Money $propertyMoney)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyNumber   = $propertyNumber;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
