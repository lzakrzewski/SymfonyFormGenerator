<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\PropertyTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Guesser\Guess;
use Lucaszz\SymfonyFormGenerator\Guesser\PHPDocGuesser;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithCustomProperty;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
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
        $this->mapper->getFormType('string')->willReturn('text');

        $guess = $this->guesser->guess(ObjectWithPhpDocMetadataOnProperties::class, 'propertyString');

        $this->assertEquals(Guess::withDefaultOptions('text'), $guess);
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
    public function it_can_guess_type_of_custom_class_properties()
    {
        $this->mapper->getFormType('\Lucaszz\SymfonyFormGenerator\Tests\fixtures\CustomValueObject')->willReturn('custom_value_object');

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
