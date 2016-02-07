<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Guesser;

use Lzakrzewski\SymfonyFormGenerator\Guesser\ChainGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\FormTypeGuesser;
use Lzakrzewski\SymfonyFormGenerator\Guesser\Guess;
use Prophecy\Prophecy\ObjectProphecy;

class ChainGuesserTest extends \PHPUnit_Framework_TestCase
{
    /** @var ObjectProphecy|FormTypeGuesser */
    private $lowPriorityGuesser;
    /** @var ObjectProphecy|FormTypeGuesser */
    private $mediumPriorityGuesser;
    /** @var ObjectProphecy|FormTypeGuesser */
    private $highPriorityGuesser;

    /** @var ChainGuesser */
    private $guesser;

    /** @test */
    public function it_guess_in_chain()
    {
        $expectedGuess = new Guess('guess', []);

        $this->mediumPriorityGuesser->guess(\stdClass::class, 'property')->willReturn($expectedGuess);

        $guess = $this->guesser->guess(\stdClass::class, 'property');

        $this->assertSame($expectedGuess, $guess);
    }

    /** @test */
    public function it_guess_with_priorities()
    {
        $lowPriorityGuess    = new Guess('low', []);
        $mediumPriorityGuess = new Guess('medium', []);
        $highPriorityGuess   = new Guess('high', []);

        $this->lowPriorityGuesser->guess(\stdClass::class, 'property')->willReturn($lowPriorityGuess);
        $this->mediumPriorityGuesser->guess(\stdClass::class, 'property')->willReturn($mediumPriorityGuess);
        $this->highPriorityGuesser->guess(\stdClass::class, 'property')->willReturn($highPriorityGuess);

        $guess = $this->guesser->guess(\stdClass::class, 'property');

        $this->assertSame($highPriorityGuess, $guess);
    }

    /** @test */
    public function it_returns_default_guess()
    {
        $guess = $this->guesser->guess(\stdClass::class, 'property');

        $this->assertInstanceOf(Guess::class, $guess);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->lowPriorityGuesser    = $this->prophesize(FormTypeGuesser::class);
        $this->mediumPriorityGuesser = $this->prophesize(FormTypeGuesser::class);
        $this->highPriorityGuesser   = $this->prophesize(FormTypeGuesser::class);

        $this->guesser = new ChainGuesser();

        $this->guesser->add($this->mediumPriorityGuesser->reveal(), 50);
        $this->guesser->add($this->highPriorityGuesser->reveal(), 100);
        $this->guesser->add($this->lowPriorityGuesser->reveal(), 10);
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->guesser = null;
    }
}
