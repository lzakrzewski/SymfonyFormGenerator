<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Guess\TypeGuess;

class HintTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var HintTypeGuesser */
    private $guesser;
    /** @var TypeGuessResolver|ObjectProphecy */
    private $resolver;
    /** @var TypeGuess|ObjectProphecy */
    private $typeGuess;

    /** @test */
    public function it_does_not_guess_required()
    {
        $this->assertNull($this->guesser->guessRequired(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_max_length()
    {
        $this->assertNull($this->guesser->guessMaxLength(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_pattern()
    {
        $this->assertNull($this->guesser->guessPattern(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_not_read_type_of_properties_without_hint()
    {
        $this->resolver->resolve(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guessType(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_type_of_datetime_properties()
    {
        $this->resolver->resolve('DateTime')->willReturn($this->typeGuess->reveal());

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithTypeHinting::class, 'propertyDateTime'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->typeGuess = $this->prophesize(TypeGuess::class);
        $this->resolver  = $this->prophesize(TypeGuessResolver::class);

        $this->guesser = new HintTypeGuesser($this->resolver->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->typeGuess = null;
        $this->resolver  = null;

        $this->guesser = null;
    }
}
