<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithPhpDocMetadataOnProperties
{
    /** @var int */
    public $propertyInteger;
    /** @var string */
    public $propertyString;
    /** @var \DateTime */
    public $propertyDateTime;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
    }
}
