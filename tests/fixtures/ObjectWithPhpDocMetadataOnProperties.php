<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnProperties
{
    /** @var int */
    public $propertyInteger;
    /** @var string */
    public $propertyString;
    /** @var \DateTime */
    public $propertyDateTime;
    /** @var UuidInterface */
    public $propertyUuid;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
    }
}
