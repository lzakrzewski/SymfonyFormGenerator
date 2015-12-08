<?php

namespace Lucaszz\SymfonyFormGenerator;

use Lucaszz\SymfonyFormGenerator\Annotation\Form;
use Symfony\Component\Validator\Constraints as Assert;

class ObjectWithMixedMetadata
{
    /**
     * @var bool
     */
    public $propertyBoolean;

    /**
     * @Assert\Count(max="5")
     */
    public $propertyArray;

    /**
     * @Form\Field("integer", options={"label"="Property Integer"})
     */
    public $propertyInteger;

    public $propertyDateTime;

    public $propertyUndefined;

    public function __construct($propertyBoolean, $propertyArray, $propertyInteger, \DateTime $propertyDateTime, $propertyUndefined)
    {
        $this->propertyBoolean   = $propertyBoolean;
        $this->propertyArray     = $propertyArray;
        $this->propertyInteger   = $propertyInteger;
        $this->propertyDateTime  = $propertyDateTime;
        $this->propertyUndefined = $propertyUndefined;
    }
}
