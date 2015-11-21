<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyGenericForm\Form\Guesser\Resolver\TypeGuessResolver;
use Lucaszz\SymfonyGenericForm\Generator;
use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadata;

class GeneratorTest extends FormTestCase
{
    /** @var Generator */
    private $generator;

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_for_non_objects()
    {
        $this->generator->generate([1, 2, 3, 4]);
    }

    /** @test */
    public function it_can_generate_form_from_object_without_metadata()
    {
        $object = new ObjectWithoutMetadata(1, 'test', new \DateTime());

        $form = $this->generator->generate($object);

        $this->assertThatFormFieldHasType('text', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('text', 'propertyDateTime', $form);
    }

    /** @test */
    public function it_can_generate_form_from_object_with_phpdoc_annotations()
    {
        $object = new ObjectWithPhpDocMetadata(1, 'test', new \DateTime());

        $form = $this->generator->generate($object);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('datetime', 'propertyDateTime', $form);
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        parent::setUp();

        $this->generator = new Generator($this->builder, new PropertyNamesReader());
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->generator = null;
    }

    /** {@inheritdoc} */
    protected function getTypeGuessers()
    {
        return [
            new PHPDocTypeGuesser(new TypeGuessResolver()),
        ];
    }
}
