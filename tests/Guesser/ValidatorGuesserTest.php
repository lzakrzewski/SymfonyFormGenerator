<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Guesser;

use Lzakrzewski\SymfonyFormGenerator\Guesser\Guess;
use Lzakrzewski\SymfonyFormGenerator\Guesser\ValidatorGuesser;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithAssertAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser;
use Symfony\Component\Form\Guess\TypeGuess;

class ValidatorGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var ObjectProphecy|PropertyTypeToFormTypeMapper */
    private $mapper;
    /** @var ObjectProphecy|ValidatorTypeGuesser */
    private $symfonyGuesser;
    /** @var ValidatorGuesser */
    private $guesser;

    /** @test */
    public function it_can_guess_basing_on_validator_metadata()
    {
        $this->symfonyGuesser->guessType(ObjectWithAssertAnnotations::class, 'propertyDateTime')->willReturn(new TypeGuess('datetime', [], TypeGuess::HIGH_CONFIDENCE));

        $guess = $this->guesser->guess(ObjectWithAssertAnnotations::class, 'propertyDateTime');

        $this->assertEquals(Guess::withDefaultOptions('generator_datetime'), $guess);
    }

    /** @test */
    public function it_does_not_guess_when_no_validator_metadata()
    {
        $this->assertNull($this->guesser->guess(ObjectWithoutMetadata::class, 'propertyInteger'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper         = $this->prophesize(PropertyTypeToFormTypeMapper::class);
        $this->symfonyGuesser = $this->prophesize(ValidatorTypeGuesser::class);

        $this->guesser = new ValidatorGuesser($this->mapper->reveal(), $this->symfonyGuesser->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->guesser = null;
    }
}
