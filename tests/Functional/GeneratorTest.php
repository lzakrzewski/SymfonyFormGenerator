<?php

namespace Lucaszz\SymfonyGenericForm\Tests;

use Lucaszz\SymfonyGenericForm\Generator;
use Lucaszz\SymfonyGenericForm\Reader\PropertyNamesReader;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadata;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\Test\TypeTestCase;

class GeneratorTest extends TypeTestCase
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

    /**
     * @test
     * @dataProvider objects
     */
    public function it_can_generate_form_from_given_object($object)
    {
        $form = $this->generator->generate($object);

        $this->assertEquals($this->expectedForm(), $form);
    }

    public function objects()
    {
        return [
            [new ObjectWithoutMetadata(1, 'abcd', new \DateTime(), Uuid::uuid4())],
            [new ObjectWithPhpDocMetadata(1, 'abcd', new \DateTime(), Uuid::uuid4())],
        ];
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

    private function expectedForm()
    {
        return $this->builder
            ->create('form', null, ['compound' => true])
            ->add('int', null)
            ->add('string', null)
            ->add('dateTime', null)
            ->add('uuid', null)
            ->getForm();
    }
}
