<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Functional;

use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithAssertAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithMixedMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\FormInterface;

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
    }

    public function invalidData()
    {
        return [
            [
                ObjectWithoutMetadata::class,
                [
                    'propertyBoolean'  => null,
                    'propertyArray'    => null,
                    'propertyInteger'  => null,
                    'propertyNumber'   => null,
                    'propertyString'   => null,
                    'propertyDateTime' => null,
                    'propertyUuid'     => null,
                    'propertyMoney'    => null,
                ],
            ],
            [
                ObjectWithTypeHinting::class,
                [
                    'propertyBoolean'  => null,
                    'propertyArray'    => null,
                    'propertyInteger'  => null,
                    'propertyNumber'   => null,
                    'propertyString'   => null,
                    'propertyDateTime' => 'invalid-date-time',
                    'propertyUuid'     => 'invalid-uuid',
                    'propertyMoney'    => '100xxUSD',
                ],
            ],
            [
                ObjectWithPhpDocMetadataOnProperties::class,
                [
                    'propertyBoolean'  => [],
                    'propertyArray'    => [],
                    'propertyInteger'  => 'string',
                    'propertyNumber'   => 'string',
                    'propertyString'   => [],
                    'propertyDateTime' => 'invalid-date-time',
                    'propertyUuid'     => 'invalid-uuid',
                    'propertyMoney'    => '100xxUSD',
                ],
            ],
            [
                ObjectWithFormAnnotations::class,
                [
                    'propertyBoolean'  => [],
                    'propertyArray'    => [],
                    'propertyInteger'  => 'string',
                    'propertyNumber'   => 'string',
                    'propertyString'   => [],
                    'propertyDateTime' => 'invalid-date-time',
                    'propertyUuid'     => 'invalid-uuid',
                    'propertyMoney'    => '100xxUSD',
                ],
            ],
            [
                ObjectWithAssertAnnotations::class,
                [
                    'propertyBoolean'  => 'test1234567',
                    'propertyArray'    => 'test1234567',
                    'propertyInteger'  => 40,
                    'propertyNumber'   => 40,
                    'propertyString'   => 'test1234567',
                    'propertyDateTime' => 'invalid-date-time',
                    'propertyUuid'     => null,
                    'propertyMoney'    => null,
                ],
            ],
            [
                ObjectWithMixedMetadata::class,
                [
                    'propertyBoolean'  => [],
                    'propertyArray'    => [],
                    'propertyInteger'  => 'string',
                    'propertyNumber'   => 'string',
                    'propertyString'   => [],
                    'propertyDateTime' => 'invalid-date-time',
                    'propertyUuid'     => 'invalid-uuid',
                    'propertyMoney'    => '100xxUSD',
                ],
            ],
        ];
    }

    private function assertThatFormIsNotValid(FormInterface $form)
    {
        $this->assertFalse($form->isValid());
        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isSynchronized());

        $this->assertFalse($form->get('propertyInteger')->isValid());
        $this->assertFalse($form->get('propertyNumber')->isValid());
        $this->assertFalse($form->get('propertyString')->isValid());
        $this->assertFalse($form->get('propertyDateTime')->isValid());
        $this->assertFalse($form->get('propertyUuid')->isValid());
        $this->assertFalse($form->get('propertyMoney')->isValid());
    }
}
