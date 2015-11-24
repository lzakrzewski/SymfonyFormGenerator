<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Ramsey\Uuid\UuidInterface;

class ObjectWithTypeHinting
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;

    public function __construct($propertyInteger, $propertyString, \DateTime $propertyDateTime, UuidInterface $propertyUuid)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
    }
}
