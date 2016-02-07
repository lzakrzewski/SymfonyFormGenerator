<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Functional;

use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithAssertAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithMixedMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\FormInterface;

class GenerateFormTest extends FunctionalTestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_array()
    {
        $this->generator->generateFormBuilder([1, 2, 3, 4]);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_object()
    {
        $this->generator->generateFormBuilder(new \stdClass());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_can_not_generate_form_not_existing_class()
    {
        $this->generator->generateFormBuilder('NonExistingNamespace\NonExistingClass');
    }

    /**
     * @test
     * @dataProvider expectedFormTypes
     */
    public function it_can_generate_form_for_given_class($className, $expectedTypes)
    {
        $form = $this->generator->generateFormBuilder($className)->getForm();

        $this->assertThatFormFieldsHasExpectedTypes($expectedTypes, $form);
    }

    /**
     * @return array
     */
    public function expectedFormTypes()
    {
        return [
            [
                ObjectWithoutMetadata::class,
                [
                    'propertyBoolean'  => 'generator_string',
                    'propertyArray'    => 'generator_string',
                    'propertyInteger'  => 'generator_string',
                    'propertyNumber'   => 'generator_string',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_string',
                    'propertyUuid'     => 'generator_string',
                    'propertyMoney'    => 'generator_string',
                ],
            ],
            [
                ObjectWithTypeHinting::class,
                [
                    'propertyBoolean'  => 'generator_string',
                    'propertyArray'    => 'generator_array',
                    'propertyInteger'  => 'generator_string',
                    'propertyNumber'   => 'generator_string',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_datetime',
                    'propertyUuid'     => 'generator_uuid',
                    'propertyMoney'    => 'generator_money',
                ],
            ],
            [
                ObjectWithPhpDocMetadataOnProperties::class,
                [
                    'propertyBoolean'  => 'checkbox',
                    'propertyArray'    => 'generator_array',
                    'propertyInteger'  => 'integer',
                    'propertyNumber'   => 'number',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_datetime',
                    'propertyUuid'     => 'generator_uuid',
                    'propertyMoney'    => 'generator_money',
                ],
            ],
            [
                ObjectWithFormAnnotations::class,
                [
                    'propertyBoolean'  => 'checkbox',
                    'propertyArray'    => 'generator_array',
                    'propertyInteger'  => 'integer',
                    'propertyNumber'   => 'number',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_datetime',
                    'propertyUuid'     => 'generator_uuid',
                    'propertyMoney'    => 'generator_money',
                ],
            ],
            [
                ObjectWithAssertAnnotations::class,
                [
                    'propertyBoolean'  => 'checkbox',
                    'propertyArray'    => 'generator_array',
                    'propertyInteger'  => 'number',
                    'propertyNumber'   => 'number',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_datetime',
                    'propertyUuid'     => 'generator_string',
                    'propertyMoney'    => 'generator_string',
                ],
            ],
            [
                ObjectWithMixedMetadata::class,
                [
                    'propertyBoolean'  => 'checkbox',
                    'propertyArray'    => 'generator_string',
                    'propertyInteger'  => 'integer',
                    'propertyNumber'   => 'number',
                    'propertyString'   => 'generator_string',
                    'propertyDateTime' => 'generator_datetime',
                    'propertyUuid'     => 'generator_uuid',
                    'propertyMoney'    => 'generator_money',
                ],
            ],
        ];
    }

    private function assertThatFormFieldHasType($expectedType, $fieldName, FormInterface $form)
    {
        $name = $form->get($fieldName)->getConfig()->getType()->getName();

        $this->assertEquals($expectedType, $name);
    }

    private function assertThatFormFieldsHasExpectedTypes(array $expectedTypes, FormInterface $form)
    {
        foreach ($expectedTypes as $propertyName => $expectedType) {
            $this->assertThatFormFieldHasType($expectedType, $propertyName, $form);
        }
    }
}
