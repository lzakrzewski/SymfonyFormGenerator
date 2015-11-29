<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Lucaszz\SymfonyFormGenerator\Annotation\Form;

class ObjectWithFormAnnotations
{
    /** @Form\Field("integer", options={"label"="Property Integer"}) */
    public $propertyInteger;
    /** @Form\Field("text", options={"label"="Property String"}) */
    public $propertyString;
    /** @Form\Field("generator_datetime", options={"label"="Property DateTime"}) */
    public $propertyDateTime;
    /** @Form\Field("generator_uuid", options={"label"="Property Uuid"}) */
    public $propertyUuid;
    /** @Form\Field("generator_money", options={"label"="Property Money"}) */
    public $propertyMoney;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
