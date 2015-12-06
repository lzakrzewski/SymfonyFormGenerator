<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Guesser;

use Lucaszz\SymfonyFormGenerator\Guesser\Guess;
use Lucaszz\SymfonyFormGenerator\Guesser\TypeHintGuesser;
use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Validator\Constraints\NotBlank;

class TypeHintGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var PropertyTypeToFormTypeMapper|ObjectProphecy */
    private $mapper;
    /** @var TypeHintGuesser */
    private $guesser;

    /** @test */
    public function it_does_not_guess_when_no_type_hint()
    {
        $this->mapper->getFormType(Argument::any())->shouldNotBeCalled();

        $this->assertNull($this->guesser->guess(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_guess_from_class_type_hint()
    {
        $this->mapper->getFormType(\DateTime::class)->willReturn('generator_datetime');

        $guess = $this->guesser->guess(ObjectWithTypeHinting::class, 'propertyDateTime');

        $this->assertEquals(new Guess('generator_datetime', ['constraints' => new NotBlank()]), $guess);
    }

    /** @test */
    public function it_can_guess_from_array_type_hint()
    {
        $this->mapper->getFormType('array')->willReturn('collection');

        $guess = $this->guesser->guess(ObjectWithTypeHinting::class, 'propertyArray');

        $this->assertEquals(new Guess('collection', ['constraints' => new NotBlank()]), $guess);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->mapper = $this->prophesize(PropertyTypeToFormTypeMapper::class);

        $this->guesser = new TypeHintGuesser($this->mapper->reveal());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->mapper = null;

        $this->guesser = null;
    }
}
