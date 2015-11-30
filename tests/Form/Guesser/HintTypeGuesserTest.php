<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\VariableTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class HintTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var VariableTypeToFormTypeMapper|ObjectProphecy */
    private $mapper;
    /** @var TypeGuessFactory|ObjectProphecy */
    private $factory;
    /** @var HintTypeGuesser */
    private $guesser;

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
    public function it_can_not_guess_type_of_properties_without_hint()
    {
        $this->mapper->getFormType(Argument::any())->shouldNotBeCalled();
        $this->factory->create(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guessType(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_guess_type_of_datetime_properties()
    {
        $this->mapper->getFormType(\DateTime::class)->willReturn('generator_datetime');
        $this->factory->create('generator_datetime')->willReturn(new TypeGuess('generator_datetime', [], Guess::HIGH_CONFIDENCE));

        $this->assertInstanceOf(TypeGuess::class, $this->guesser->guessType(ObjectWithTypeHinting::class, 'propertyDateTime'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper  = $this->prophesize(VariableTypeToFormTypeMapper::class);
        $this->factory = $this->prophesize(TypeGuessFactory::class);

        $this->guesser = new HintTypeGuesser($this->mapper->reveal(), $this->factory->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->mapper  = null;
        $this->factory = null;

        $this->guesser = null;
    }
}
