<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;

    public function __construct($int, $string, $dateTime, $uuid)
    {
        $this->propertyInteger      = $int;
        $this->propertyString   = $string;
        $this->propertyDateTime = $dateTime;
        $this->propertyUuid     = $uuid;
    }
}
