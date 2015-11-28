<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnConstructorParams;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\FormInterface;

/**
 * @todo: missing test cases for mixed metadata of classes
 */
class GenerateFormTest extends FunctionalTestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_array()
    {
        $this->generator->generate([1, 2, 3, 4]);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_object()
    {
        $this->generator->generate(new \stdClass());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_not_existing_class()
    {
        $this->generator->generate('NonExistingNamespace\NonExistingClass');
    }

    /** @test */
    public function it_can_generate_form_from_class_without_metadata()
    {
        $form = $this->generator->generate(ObjectWithoutMetadata::class);

        $this->assertThatFormFieldHasType('text', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('text', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('text', 'propertyUuid', $form);
        $this->assertThatFormFieldHasType('text', 'propertyMoney', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_type_hints()
    {
        $form = $this->generator->generate(ObjectWithTypeHinting::class);

        $this->assertThatFormFieldHasType('text', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
        $this->assertThatFormFieldHasType('generic_money', 'propertyMoney', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_phpdoc_annotations_on_properties()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
        $this->assertThatFormFieldHasType('generic_money', 'propertyMoney', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_phpdoc_annotations_on_constructor_parameters()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnConstructorParams::class);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
        $this->assertThatFormFieldHasType('generic_money', 'propertyMoney', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_form_annotations()
    {
        $form = $this->generator->generate(ObjectWithFormAnnotations::class);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
        $this->assertThatFormFieldHasType('generic_money', 'propertyMoney', $form);
    }

    private function assertThatFormFieldHasType($expectedType, $fieldName, FormInterface $form)
    {
        $name = $form->get($fieldName)->getConfig()->getType()->getName();

        $this->assertEquals($expectedType, $name);
    }
}
