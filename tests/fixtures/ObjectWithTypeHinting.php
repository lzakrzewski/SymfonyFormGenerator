<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithTypeHinting
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;

    public function __construct($propertyInteger, $propertyString, \DateTime $propertyDateTime)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
    }
}
