<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Functional;

use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithAssertAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithFormAnnotations;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithMixedMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithoutMetadata;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithPhpDocMetadataOnProperties;
use Lzakrzewski\SymfonyFormGenerator\Tests\fixtures\ObjectWithTypeHinting;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\FormInterface;

class SubmitGeneratedFormTest extends FunctionalTestCase
{
    /**
     * @test
     * @dataProvider expectedObjects
     */
    public function it_can_submit_generated_form($className, $expectedObject)
    {
        $form = $this->generator->generateFormBuilder($className)->getForm();

        $form->submit($this->validFormData());
        $this->assertThatFormWasSubmittedWithSuccess($form);

        $this->assertFormDataEqualsAndHasExpectedTypes($expectedObject, $form);
    }

    /**
     * @return array
     */
    public function expectedObjects()
    {
        return [
            [
                ObjectWithoutMetadata::class,
                new ObjectWithoutMetadata(
                    '1',
                    ['test'],
                    '1',
                    '0.1',
                    'test',
                    '2015-01-01 01:01:01',
                    'b771a92d-57a3-4442-ad85-165000c07f12',
                    '100 USD'
                ),
            ],
            [
                ObjectWithTypeHinting::class,
                new ObjectWithTypeHinting(
                    '1',
                    ['test'],
                    '1',
                    '0.1',
                    'test',
                    new \DateTime('2015-01-01 01:01:01'),
                    Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12'),
                    Money::USD(10000)
                ),
            ],
            [
                ObjectWithPhpDocMetadataOnProperties::class,
                new ObjectWithPhpDocMetadataOnProperties(
                    true,
                    ['test'],
                    1,
                    0.1,
                    'test',
                    new \DateTime('2015-01-01 01:01:01'),
                    Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12'),
                    Money::USD(10000)
                ),
            ],
            [
                ObjectWithFormAnnotations::class,
                new ObjectWithFormAnnotations(
                    true,
                    ['test'],
                    1,
                    0.1,
                    'test',
                    new \DateTime('2015-01-01 01:01:01'),
                    Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12'),
                    Money::USD(10000)
                ),
            ],
            [
                ObjectWithAssertAnnotations::class,
                new ObjectWithAssertAnnotations(
                    true,
                    ['test'],
                    1.0,
                    0.1,
                    'test',
                    new \DateTime('2015-01-01 01:01:01'),
                    'b771a92d-57a3-4442-ad85-165000c07f12',
                    '100 USD'
                ),
            ],
            [
                ObjectWithMixedMetadata::class,
                new ObjectWithMixedMetadata(
                    true,
                    ['test'],
                    1,
                    0.1,
                    'test',
                    new \DateTime('2015-01-01 01:01:01'),
                    Uuid::fromString('b771a92d-57a3-4442-ad85-165000c07f12'),
                    Money::USD(10000)
                ),
            ],
        ];
    }

    private function assertThatFormWasSubmittedWithSuccess(FormInterface $form)
    {
        $this->assertTrue($form->isValid());
        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isSynchronized());
    }

    private function validFormData()
    {
        return [
            'propertyBoolean'  => true,
            'propertyArray'    => ['test'],
            'propertyInteger'  => 1,
            'propertyNumber'   => 0.1,
            'propertyString'   => 'test',
            'propertyDateTime' => '2015-01-01 01:01:01',
            'propertyUuid'     => 'b771a92d-57a3-4442-ad85-165000c07f12',
            'propertyMoney'    => '100 USD',
        ];
    }

    private function assertFormDataEqualsAndHasExpectedTypes($expected, FormInterface $form)
    {
        $formData = $form->getData();

        $this->assertEquals($expected, $formData);

        if ($expected->propertyDateTime instanceof \DateTime) {
            $this->assertDateTimeEquals($expected->propertyDateTime, $formData->propertyDateTime);
        }

        if ($expected->propertyUuid instanceof Uuid) {
            $this->assertUuidEquals($expected->propertyUuid, $formData->propertyUuid);
        }

        if ($expected->propertyDateTime instanceof Money) {
            $this->assertMoneyEquals($expected->propertyMoney, $formData->propertyMoney);
        }
    }
}
