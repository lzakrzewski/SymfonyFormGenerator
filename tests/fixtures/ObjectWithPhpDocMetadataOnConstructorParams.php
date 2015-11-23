<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithPhpDocMetadataOnConstructorParams
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;

    /**
     * @param int       $propertyInteger
     * @param string    $propertyString
     * @param \DateTime $propertyDateTime
     */
    public function __construct($propertyInteger, $propertyString, $propertyDateTime)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
    }
}
