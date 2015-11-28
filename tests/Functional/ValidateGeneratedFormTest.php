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
class ValidateGeneratedFormTest extends FunctionalTestCase
{
    /** @test */
    public function it_can_not_validate_form_generated_from_class_without_metadata()
    {
        $form = $this->generator->generate(ObjectWithoutMetadata::class)->getForm();

        $form->submit([
            'propertyInteger'  => null,
            'propertyString'   => null,
            'propertyDateTime' => null,
            'propertyUuid'     => null,
            'propertyMoney'    => null,
        ]);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    /** @test */
    public function it_can_not_validate_form_generated_from_class_with_type_hints()
    {
        $form = $this->generator->generate(ObjectWithTypeHinting::class)->getForm();

        $form->submit([
            'propertyInteger'  => null,
            'propertyString'   => null,
            'propertyDateTime' => 'invalid-date-time',
            'propertyUuid'     => 'invalid-uuid',
            'propertyMoney'    => '100xxUSD',
        ]);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    /** @test */
    public function it_can_not_validate_form_generated_from_class_with_phpdoc_annotations_on_properties()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnProperties::class)->getForm();

        $form->submit([
            'propertyInteger'  => 'string',
            'propertyString'   => [],
            'propertyDateTime' => 'invalid-date-time',
            'propertyUuid'     => 'invalid-uuid',
            'propertyMoney'    => '100xxUSD',
        ]);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    /** @test */
    public function it_can_not_validate_form_generated_from_class_with_phpdoc_annotations_on_constructor_parameters()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadataOnConstructorParams::class)->getForm();

        $form->submit([
            'propertyInteger'  => 'string',
            'propertyString'   => [],
            'propertyDateTime' => 'invalid-date-time',
            'propertyUuid'     => 'invalid-uuid',
            'propertyMoney'    => '100xxUSD',
        ]);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    /** @test */
    public function it_can_not_validate_form_generated_from_class_with_form_annotations()
    {
        $form = $this->generator->generate(ObjectWithFormAnnotations::class)->getForm();

        $form->submit([
            'propertyInteger'  => 'string',
            'propertyString'   => [],
            'propertyDateTime' => 'invalid-date-time',
            'propertyUuid'     => 'invalid-uuid',
            'propertyMoney'    => '100xxUSD',
        ]);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    private function assertThatFormIsNotValid(FormInterface $form)
    {
        $this->assertFalse($form->isValid());
        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isSynchronized());
    }

    private function assertThatFormHasErrors($expectedErrorCount, FormInterface $form)
    {
        $this->assertEquals($expectedErrorCount, $form->getErrors(true)->count());
    }
}
