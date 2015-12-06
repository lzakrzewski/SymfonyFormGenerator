<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnProperties
{
    /** @var bool */
    public $propertyBoolean;
    /** @var array */
    public $propertyArray;
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
