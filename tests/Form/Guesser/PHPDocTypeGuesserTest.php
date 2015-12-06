<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\PropertyTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnConstructorParams;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Guess\TypeGuess;

class PHPDocTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var PropertyTypeToFormTypeMapper|ObjectProphecy */
    private $mapper;
    /** @var TypeGuessFactory|ObjectProphecy */
    private $factory;
    /** @var TypeGuess|ObjectProphecy */
    private $typeGuess;
    /** @var PHPDocTypeGuesser */
    private $guesser;

    /** @test */
    public function it_does_not_guess_required()
    {
        $this->assertNull($this->guesser->guessRequired(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_max_length()
    {
        $this->assertNull($this->guesser->guessMaxLength(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_pattern()
    {
        $this->assertNull($this->guesser->guessPattern(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_not_guess_type_of_properties_without_phpdoc()
    {
        $this->mapper->getFormType(Argument::any())->shouldNotBeCalled();
        $this->factory->create(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guessType(ObjectWithoutMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_integer_properties()
    {
        $this->mapper->getFormType('int')->willReturn('integer');
        $this->factory->create('integer')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_guess_type_of_string_properties()
    {
        $this->mapper->getFormType('string')->willReturn('text');
        $this->factory->create('text')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyString'));
    }

    /** @test */
    public function it_can_guess_type_of_datetime_properties()
    {
        $this->mapper->getFormType('\DateTime')->willReturn('generator_datetime');
        $this->factory->create('generator_datetime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyDateTime'));
    }

    /** @test */
    public function it_can_guess_type_of_uuid_properties()
    {
        $this->mapper->getFormType('Ramsey\Uuid\UuidInterface')->willReturn('generator_uuid');
        $this->factory->create('generator_uuid')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyUuid'));
    }

    /** @test */
    public function it_can_guess_type_of_integer_constructor_parameter()
    {
        $this->mapper->getFormType('int')->willReturn('integer');
        $this->factory->create('integer')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_guess_type_of_string_constructor_parameter()
    {
        $this->mapper->getFormType('string')->willReturn('text');
        $this->factory->create('text')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyString'));
    }

    /** @test */
    public function it_can_guess_type_of_datetime_constructor_parameter()
    {
        $this->mapper->getFormType('\DateTime')->willReturn('generator_datetime');
        $this->factory->create('generator_datetime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyDateTime'));
    }

    /** @test */
    public function it_can_guess_type_of_uuid_constructor_parameter()
    {
        $this->mapper->getFormType('Ramsey\Uuid\UuidInterface')->willReturn('generator_uuid');
        $this->factory->create('generator_uuid')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyUuid'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper    = $this->prophesize(PropertyTypeToFormTypeMapper::class);
        $this->factory   = $this->prophesize(TypeGuessFactory::class);
        $this->typeGuess = $this->prophesize(TypeGuess::class);

        $this->guesser = new PHPDocTypeGuesser($this->mapper->reveal(), $this->factory->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->mapper    = null;
        $this->factory   = null;
        $this->typeGuess = null;

        $this->guesser = null;
    }
}
