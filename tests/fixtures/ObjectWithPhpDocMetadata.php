<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadata
{
    /** @var int */
    public $int;
    /** @var string */
    public $string;
    /** @var \DateTime */
    public $dateTime;
    /** @var UuidInterface*/
    public $uuid;

    public function __construct($int, $string, $dateTime, $uuid)
    {
        $this->int      = $int;
        $this->string   = $string;
        $this->dateTime = $dateTime;
        $this->uuid     = $uuid;
    }
}
