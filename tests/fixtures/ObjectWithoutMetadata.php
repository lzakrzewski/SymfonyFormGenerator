<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyInteger;
    public $propertyNumber;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
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
