<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Guesser;

use Lzakrzewski\SymfonyFormGenerator\Guesser\Guess;
use Lzakrzewski\SymfonyFormGenerator\Guesser\PHPDocGuesser;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithCustomProperty;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class PHPDocGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var ObjectProphecy|PropertyTypeToFormTypeMapper */
    private $mapper;
    /** @var PHPDocGuesser */
    private $guesser;

    /** @test */
    public function it_can_not_guess_type_of_properties_without_phpdoc()
    {
        $this->mapper->getFormType(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guess(ObjectWithoutMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_guess_type_of_integer_properties()
    {
        $this->mapper->getFormType('int')->willReturn('integer');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger');

        $this->assertEquals(Guess::withDefaultOptions('integer'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_string_properties()
    {
        $this->mapper->getFormType('string')->willReturn('generator_string');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyString');

        $this->assertEquals(Guess::withDefaultOptions('generator_string'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_datetime_properties()
    {
        $this->mapper->getFormType('\DateTime')->willReturn('generator_datetime');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyDateTime');

        $this->assertEquals(Guess::withDefaultOptions('generator_datetime'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_uuid_properties()
    {
        $this->mapper->getFormType('\Ramsey\Uuid\UuidInterface')->willReturn('generator_uuid');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyUuid');

        $this->assertEquals(Guess::withDefaultOptions('generator_uuid'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_boolean_properties()
    {
        $this->mapper->getFormType('bool')->willReturn('checkbox');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyBoolean');

        $this->assertEquals(Guess::withDefaultOptions('checkbox'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_array_properties()
    {
        $this->mapper->getFormType('array')->willReturn('collection');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyArray');

        $this->assertEquals(Guess::withDefaultOptions('collection'), $guess);
    }

    /** @test */
    public function it_can_guess_type_of_custom_class_properties()
    {
        $this->mapper->getFormType('\Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\CustomValueObject')->willReturn('custom_value_object');

        $guess = $this->guesser->guess(ObjectWithCustomProperty::class, 'property');

        $this->assertEquals(Guess::withDefaultOptions('custom_value_object'), $guess);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper = $this->prophesize(PropertyTypeToFormTypeMapper::class);

        $this->guesser = new PHPDocGuesser($this->mapper->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->mapper = null;

        $this->guesser = null;
    }
}
