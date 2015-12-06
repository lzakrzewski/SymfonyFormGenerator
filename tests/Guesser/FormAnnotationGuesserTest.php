<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Guesser;

use Lucaszz\SymfonyFormGenerator\Guesser\FormAnnotationGuesser;
use Lucaszz\SymfonyFormGenerator\Guesser\Guess;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;

class FormAnnotationGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var FormAnnotationGuesser */
    private $guesser;

    /** @test */
    public function it_can_not_read_type_of_properties_without_hint()
    {
        $this->assertNull($this->guesser->guess(ObjectWithTypeHinting::class, 'propertyInteger'));
    }

    /** @test */
    public function it_can_read_form_annotations()
    {
        $guess = $this->guesser->guess(ObjectWithFormAnnotations::class, 'propertyDateTime');

        $this->assertEquals(
            new Guess('generator_datetime', ['label' => 'Property DateTime']),
            $guess
        );
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->guesser = new FormAnnotationGuesser();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->guesser = null;
    }
}
