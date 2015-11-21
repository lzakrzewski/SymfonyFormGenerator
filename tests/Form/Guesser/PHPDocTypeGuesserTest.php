<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Form\Guesser;

use Lucaszz\SymfonyGenericForm\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadata;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Guess\TypeGuess;

class PHPDocTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var PHPDocTypeGuesser */
    private $guesser;
    /** @var TypeGuessResolver|ObjectProphecy */
    private $resolver;
    /** @var TypeGuess|ObjectProphecy */
    private $typeGuess;

    /** @test */
    public function it_does_not_guess_required()
    {
        $this->assertNull($this->guesser->guessRequired(ObjectWithPhpDocMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_max_length()
    {
        $this->assertNull($this->guesser->guessMaxLength(ObjectWithPhpDocMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_pattern()
    {
        $this->assertNull($this->guesser->guessPattern(ObjectWithPhpDocMetadata::class, 'propertyInteger'));
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

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadata::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_string_properties()
    {
        $this->resolver->resolve('string')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadata::class, 'propertyString'));
    }

    /** @test */
    public function it_can_read_type_of_datetime_properties()
    {
        $this->resolver->resolve('\DateTime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithPhpDocMetadata::class, 'propertyDateTime'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->typeGuess = $this->prophesize(TypeGuess::class);
        $this->resolver  = $this->prophesize(TypeGuessResolver::class);

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
