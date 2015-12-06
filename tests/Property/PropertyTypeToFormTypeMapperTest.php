<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Property;

use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class PropertyTypeToFormTypeMapperTest extends \PHPUnit_Framework_TestCase
{
    /** @var PropertyTypeToFormTypeMapper */
    private $mapper;

    /** @test */
    public function it_returns_null_when_no_mappings()
    {
        $this->assertNull($this->mapper->getFormType('int'));
    }

    /** @test */
    public function it_can_be_constructed_with_default_values()
    {
        $mapper = PropertyTypeToFormTypeMapper::withDefaultMappings();

        $this->assertInstanceOf(PropertyTypeToFormTypeMapper::class, $mapper);
    }

    /** @test */
    public function it_can_map_non_class_types()
    {
        $this->mapper->addMapping('int', 'integer');

        $this->assertEquals('integer', $this->mapper->getFormType('int'));
    }

    /** @test */
    public function it_can_map_class_types()
    {
        $this->mapper->addMapping(Money::class, 'generator_money');

        $this->assertEquals('generator_money', $this->mapper->getFormType(Money::class));
    }

    /** @test */
    public function it_can_map_class_types_given_without_slash()
    {
        $this->mapper->addMapping('Money\Money', 'generator_money');

        $this->assertEquals('generator_money', $this->mapper->getFormType(Money::class));
    }

    /** @test */
    public function it_can_map_class_types_given_as_interface()
    {
        $this->mapper->addMapping(UuidInterface::class, 'generator_uuid');

        $this->assertEquals('generator_uuid', $this->mapper->getFormType(Uuid::class));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper = new PropertyTypeToFormTypeMapper();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->mapper = null;
    }
}
