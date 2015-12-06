<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Guesser;

use Lucaszz\SymfonyFormGenerator\Guesser\Guess;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class GuessTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_have_default_options()
    {
        $guess = Guess::withDefaultOptions('some_type');

        $this->assertEquals(
            new Guess('some_type', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_datetime_type()
    {
        $guess = Guess::withDefaultOptions('datetime');

        $this->assertEquals(
            new Guess('generator_datetime', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_datetime_type_instance()
    {
        $guess = Guess::withDefaultOptions(new DateTimeType());

        $this->assertEquals(
            new Guess('generator_datetime', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_datetime_class()
    {
        $guess = Guess::withDefaultOptions(DateTimeType::class);

        $this->assertEquals(
            new Guess('generator_datetime', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_text_type()
    {
        $guess = Guess::withDefaultOptions('text');

        $this->assertEquals(
            new Guess('generator_string', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_text_type_instance()
    {
        $guess = Guess::withDefaultOptions(new TextType());

        $this->assertEquals(
            new Guess('generator_string', ['constraints' => new NotBlank()]),
            $guess
        );
    }

    /** @test */
    public function it_can_convert_text_type_class()
    {
        $guess = Guess::withDefaultOptions(TextType::class);

        $this->assertEquals(
            new Guess('generator_string', ['constraints' => new NotBlank()]),
            $guess
        );
    }
}
