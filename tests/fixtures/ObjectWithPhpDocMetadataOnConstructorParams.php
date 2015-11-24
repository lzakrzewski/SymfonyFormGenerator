<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ObjectWithPhpDocMetadataOnConstructorParams
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;
    public $propertyMoney;

    /**
     * @param int $propertyInteger
     * @param string $propertyString
     * @param \DateTime $propertyDateTime
     * @param UuidInterface $propertyUuid
     * @param Money $propertyMoney
     */
    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid, $propertyMoney)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
        $this->propertyMoney = $propertyMoney;
    }
}
