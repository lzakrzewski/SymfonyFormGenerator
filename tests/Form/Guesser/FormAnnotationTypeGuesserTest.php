<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\FormAnnotationTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\Guess\TypeGuess;

class FormAnnotationTypeGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var FormAnnotationTypeGuesser */
    private $guesser;

    /** @test */
    public function it_does_not_guess_required()
    {
        $this->assertNull($this->guesser->guessRequired(ObjectWithFormAnnotations::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_max_length()
    {
        $this->assertNull($this->guesser->guessMaxLength(ObjectWithFormAnnotations::class, 'propertyInteger'));
    }

    /** @test */
    public function it_does_not_guess_pattern()
    {
        $this->assertNull($this->guesser->guessPattern(ObjectWithFormAnnotations::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_not_read_type_of_properties_without_hint()
    {
        $this->assertNull($this->guesser->guessType(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_form_annotations()
    {
        $typeGuess = $this->guesser->guessType(ObjectWithFormAnnotations::class, 'propertyDateTime');

        $this->assertEquals(
            new TypeGuess('generator_datetime', ['label' => 'Property DateTime'], TypeGuess::HIGH_CONFIDENCE),
            $typeGuess
        );
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->guesser = new FormAnnotationTypeGuesser();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->guesser = null;
    }
}
