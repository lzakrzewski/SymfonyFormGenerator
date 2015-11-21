<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
    }
}
