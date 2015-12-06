<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Guesser;

use Lucaszz\SymfonyFormGenerator\Guesser\Guess;
use Symfony\Component\Validator\Constraints\NotBlank;

class GuessTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_have_default_options()
    {
        $guess = Guess::withDefaultOptions('some_type');

        $this->assertEquals(new Guess('some_type', ['constraints' => new NotBlank()]), $guess);
    }
}
