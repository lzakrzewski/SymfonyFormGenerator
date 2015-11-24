<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnConstructorParams
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;

    /**
     * @param int           $propertyInteger
     * @param string        $propertyString
     * @param \DateTime     $propertyDateTime
     * @param UuidInterface $propertyUuid
     */
    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
    }
}
