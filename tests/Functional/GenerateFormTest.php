<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadataOnConstructorParams;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\FormInterface;

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
    }

    /** @test */
    public function it_can_generate_form_from_class_with_type_hints()
    {
        $form = $this->generator->generate(ObjectWithTypeHinting::class);

        $this->assertThatFormFieldHasType('text', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_phpdoc_annotations_on_properties()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnProperties::class);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
    }

    /** @test */
    public function it_can_generate_form_from_class_with_phpdoc_annotations_on_constructor_parameters()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnConstructorParams::class);

        $this->assertThatFormFieldHasType('integer', 'propertyInteger', $form);
        $this->assertThatFormFieldHasType('text', 'propertyString', $form);
        $this->assertThatFormFieldHasType('generic_datetime', 'propertyDateTime', $form);
        $this->assertThatFormFieldHasType('generic_uuid', 'propertyUuid', $form);
    }

    private function assertThatFormFieldHasType($expectedType, $fieldName, FormInterface $form)
    {
        $name = $form->get($fieldName)->getConfig()->getType()->getName();

        $this->assertEquals($expectedType, $name);
    }
}
