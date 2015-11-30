<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolverLegacy;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnConstructorParams;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Guess\TypeGuess;

class PHPDocTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var PHPDocTypeGuesser */
    private $guesser;
    /** @var TypeGuessResolverLegacy|ObjectProphecy */
    private $resolver;
    /** @var TypeGuess|ObjectProphecy */
    private $typeGuess;

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
    public function it_can_not_read_type_of_properties_without_phpdoc()
    {
        $this->resolver->resolve(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guessType(ObjectWithoutMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_integer_properties()
    {
        $this->resolver->resolve('int')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_string_properties()
    {
        $this->resolver->resolve('string')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyString'));
    }

    /** @test */
    public function it_can_read_type_of_datetime_properties()
    {
        $this->resolver->resolve('\DateTime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnProperties::class, 'propertyDateTime'));
    }

    /** @test */
    public function it_can_read_type_of_integer_constructor_parameter()
    {
        $this->resolver->resolve('int')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_string_constructor_parameter()
    {
        $this->resolver->resolve('string')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyString'));
    }

    /** @test */
    public function it_can_read_type_of_datetime_constructor_parameter()
    {
        $this->resolver->resolve('\DateTime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadataOnConstructorParams::class, 'propertyDateTime'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->typeGuess = $this->prophesize(TypeGuess::class);
        $this->resolver  = $this->prophesize(TypeGuessResolverLegacy::class);

        $this->guesser = new PHPDocTypeGuesser($this->resolver->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->typeGuess = null;
        $this->resolver  = null;

        $this->guesser = null;
    }
}
