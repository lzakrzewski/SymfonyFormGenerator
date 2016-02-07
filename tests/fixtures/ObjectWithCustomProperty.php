<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\fixtures;

class ObjectWithCustomProperty
{
    /** @var CustomValueObject */
    public $property;

    /**
     * @param CustomValueObject $property
     */
    public function __construct(CustomValueObject $property)
    {
        $this->property = $property;
    }
}
