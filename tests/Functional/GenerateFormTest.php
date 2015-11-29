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

    /**
     * @test
     * @dataProvider expectedFormTypes
     */
    public function it_can_generate_form_for_given_class($className, $expectedTypes)
    {
        $form = $this->generator->generate($className)->getForm();

        $this->assertThatFormFieldsHasExpectedTypes($expectedTypes, $form);
    }

    /**
     * @return array
     */
    public function expectedFormTypes()
    {
        return [
            [ObjectWithoutMetadata::class, ['propertyInteger' => 'text', 'propertyString' => 'text', 'propertyDateTime' => 'text', 'propertyUuid' => 'text', 'propertyMoney' => 'text']],
            [ObjectWithTypeHinting::class, ['propertyInteger' => 'text', 'propertyString' => 'text', 'propertyDateTime' => 'generator_datetime', 'propertyUuid' => 'generator_uuid', 'propertyMoney' => 'generator_money']],
            [ObjectWithPhpDocMetadataOnProperties::class, ['propertyInteger' => 'integer', 'propertyString' => 'text', 'propertyDateTime' => 'generator_datetime', 'propertyUuid' => 'generator_uuid', 'propertyMoney' => 'generator_money']],
            [ObjectWithPhpDocMetadataOnConstructorParams::class, ['propertyInteger' => 'integer', 'propertyString' => 'text', 'propertyDateTime' => 'generator_datetime', 'propertyUuid' => 'generator_uuid', 'propertyMoney' => 'generator_money']],
            [ObjectWithFormAnnotations::class, ['propertyInteger' => 'integer', 'propertyString' => 'text', 'propertyDateTime' => 'generator_datetime', 'propertyUuid' => 'generator_uuid', 'propertyMoney' => 'generator_money']],
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
