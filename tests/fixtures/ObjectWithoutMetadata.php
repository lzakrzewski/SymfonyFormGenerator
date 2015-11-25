<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
    public $propertyMoney;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
