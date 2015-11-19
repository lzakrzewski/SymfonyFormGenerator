<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadata
{
    /** @var int */
    public $propertyInteger;
    /** @var string */
    public $propertyString;
    /** @var \DateTime */
    public $propertyDateTime;
    /** @var UuidInterface*/
    public $propertyUuid;

    public function __construct($int, $string, $dateTime, $uuid)
    {
        $this->int      = $int;
        $this->string   = $string;
        $this->dateTime = $dateTime;
        $this->uuid     = $uuid;
    }
}
