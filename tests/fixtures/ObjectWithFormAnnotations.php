<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

use Lucaszz\SymfonyFormGenerator\Annotation\Form;

class ObjectWithFormAnnotations
{
    /** @Form\Field("checkbox", options={"label"="Property Boolean"}) */
    public $propertyBoolean;
    /** @Form\Field("generator_array", options={"label"="Property Array"}) */
    public $propertyArray;
    /** @Form\Field("integer", options={"label"="Property Integer"}) */
    public $propertyInteger;
    /** @Form\Field("number", options={"label"="Property Number"}) */
    public $propertyNumber;
    /** @Form\Field("generator_string", options={"label"="Property String"}) */
    public $propertyString;
    /** @Form\Field("generator_datetime", options={"label"="Property DateTime"}) */
    public $propertyDateTime;
    /** @Form\Field("generator_uuid", options={"label"="Property Uuid"}) */
    public $propertyUuid;
    /** @Form\Field("generator_money", options={"label"="Property Money"}) */
    public $propertyMoney;

    public function __construct($propertyBoolean, $propertyArray, $propertyInteger, $propertyNumber, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
    {
        $this->propertyBoolean  = $propertyBoolean;
        $this->propertyArray    = $propertyArray;
        $this->propertyInteger  = $propertyInteger;
        $this->propertyNumber   = $propertyNumber;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney    = $propertyMoney;
    }
}
