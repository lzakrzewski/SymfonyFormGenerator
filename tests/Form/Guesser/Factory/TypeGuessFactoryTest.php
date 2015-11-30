<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser\Factory;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class TypeGuessFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var TypeGuessFactory */
    private $resolver;

    /** @test */
    public function it_creates_type_guess_for_text_form_type()
    {
        $this->assertEquals(new TypeGuess('text', [], Guess::HIGH_CONFIDENCE), $this->resolver->create('text'));
    }

    /** @test */
    public function it_creates_type_guess_for_integer_form_type()
    {
        $this->assertEquals(new TypeGuess('integer', [], Guess::MEDIUM_CONFIDENCE), $this->resolver->create('integer'));
    }

    /** @test */
    public function it_creates_type_guess_for_numeric_form_type()
    {
        $this->assertEquals(new TypeGuess('number', [], Guess::MEDIUM_CONFIDENCE), $this->resolver->create('number'));
    }

    /** @test */
    public function it_creates_type_guess_for_bool_form_type()
    {
        $this->assertEquals(new TypeGuess('checkbox', [], Guess::HIGH_CONFIDENCE), $this->resolver->create('checkbox'));
    }

    /** @test */
    public function it_creates_type_guess_for_generator_form_type()
    {
        $this->assertEquals(new TypeGuess('generator_money', [], Guess::HIGH_CONFIDENCE), $this->resolver->create('generator_money'));
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->resolver = new TypeGuessFactory();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->resolver = null;
    }
}
