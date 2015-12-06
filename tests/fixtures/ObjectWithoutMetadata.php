<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyBoolean;
    public $propertyArray;
    public $propertyInteger;
    public $propertyNumber;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
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
