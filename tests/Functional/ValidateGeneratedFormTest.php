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
    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_can_not_validate_form_with_invalid_data($className, $invalidData)
    {
        $form = $this->generator->generateFormBuilder($className)->getForm();

        $form->submit($invalidData);

        $this->assertThatFormIsNotValid($form);
        $this->assertThatFormHasErrors(5, $form);
    }

    public function invalidData()
    {
        return [
            [ObjectWithoutMetadata::class, ['propertyInteger' => null, 'propertyString' => null, 'propertyDateTime' => null, 'propertyUuid' => null, 'propertyMoney' => null]],
            [ObjectWithTypeHinting::class, ['propertyInteger' => null, 'propertyString' => null, 'propertyDateTime' => 'invalid-date-time', 'propertyUuid' => 'invalid-uuid', 'propertyMoney' => '100xxUSD']],
            [ObjectWithPhpDocMetadataOnProperties::class, ['propertyInteger' => 'string', 'propertyString' => [], 'propertyDateTime' => 'invalid-date-time', 'propertyUuid' => 'invalid-uuid', 'propertyMoney' => '100xxUSD']],
            [ObjectWithPhpDocMetadataOnConstructorParams::class, ['propertyInteger' => 'string', 'propertyString' => [], 'propertyDateTime' => 'invalid-date-time', 'propertyUuid' => 'invalid-uuid', 'propertyMoney' => '100xxUSD']],
            [ObjectWithFormAnnotations::class, ['propertyInteger' => 'string', 'propertyString' => [], 'propertyDateTime' => 'invalid-date-time', 'propertyUuid' => 'invalid-uuid', 'propertyMoney' => '100xxUSD']],
        ];
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
