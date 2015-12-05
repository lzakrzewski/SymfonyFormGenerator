<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnProperties
{
    /** @var int */
    public $propertyInteger;
    /** @var float */
    public $propertyNumber;
    /** @var string */
    public $propertyString;
    /** @var \DateTime */
    public $propertyDateTime;
    /** @var UuidInterface */
    public $propertyUuid;
    /** @var Money */
    public $propertyMoney;

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
