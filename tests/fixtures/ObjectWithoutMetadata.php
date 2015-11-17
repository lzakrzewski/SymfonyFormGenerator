<?php

namespace Lucaszz\SymfonyGenericFormType\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $int;
    public $string;
    public $dateTime;
    public $uuid;

    public function __construct($int, $string, $dateTime, $uuid)
    {
        $this->int      = $int;
        $this->string   = $string;
        $this->dateTime = $dateTime;
        $this->uuid     = $uuid;
    }
}
