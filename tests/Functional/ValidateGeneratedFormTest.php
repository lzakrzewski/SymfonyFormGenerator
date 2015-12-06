<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Functional;

use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithAssertAnnotations;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithMixedMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lucaszz\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
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
