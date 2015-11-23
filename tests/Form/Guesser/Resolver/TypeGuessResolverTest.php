<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Form\Guesser\Resolver;

use Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver\TypeGuessResolver;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\TypeGuess;

class TypeGuessResolverTest extends \PHPUnit_Framework_TestCase
{
    /** @var TypeGuessResolver */
    private $resolver;

    /**
     * @test
     * @dataProvider types
     */
    public function it_resolves_type_guess_from_variable_type($typeGuess, $propertyType)
    {
        $this->assertEquals($typeGuess, $this->resolver->resolve($propertyType));
    }

    /** @test */
    public function it_resolves_text_type_guess_from_unknown_property_type()
    {
        $this->assertEquals(new TypeGuess('text', [], Guess::LOW_CONFIDENCE), $this->resolver->resolve('unknown'));
    }

    public function types()
    {
        return [
            [new TypeGuess('text', [], Guess::HIGH_CONFIDENCE), 'string'],
            [new TypeGuess('integer', [], Guess::MEDIUM_CONFIDENCE), 'integer'],
            [new TypeGuess('integer', [], Guess::MEDIUM_CONFIDENCE), 'int'],
            [new TypeGuess('number', [], Guess::MEDIUM_CONFIDENCE), 'float'],
            [new TypeGuess('number', [], Guess::MEDIUM_CONFIDENCE), 'double'],
            [new TypeGuess('number', [], Guess::MEDIUM_CONFIDENCE), 'real'],
            [new TypeGuess('checkbox', [], Guess::HIGH_CONFIDENCE), 'boolean'],
            [new TypeGuess('checkbox', [], Guess::HIGH_CONFIDENCE), 'bool'],
            [new TypeGuess('generic_datetime', [], Guess::HIGH_CONFIDENCE), 'DateTime'],
            [new TypeGuess('generic_datetime', [], Guess::HIGH_CONFIDENCE), '\DateTime'],
        ];
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->resolver = new TypeGuessResolver();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->resolver = null;
    }
}
