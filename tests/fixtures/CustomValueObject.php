<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\fixtures;

final class CustomValueObject
{
    /** @var string */
    private $value;

    /**
     * @param string $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return CustomValueObject
     */
    public static function create($value)
    {
        return new self($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
