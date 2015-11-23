<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Functional;

use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithoutMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithPhpDocMetadata;
use Lucaszz\SymfonyGenericForm\Tests\fixtures\ObjectWithTypeHinting;
use Symfony\Component\Form\FormInterface;

class SubmitGeneratedFormTest extends FunctionalTestCase
{
    /** @test */
    public function it_can_submit_form_generated_form_from_class_without_metadata()
    {
        $form = $this->generator->generate(ObjectWithoutMetadata::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertEquals(new ObjectWithoutMetadata('1', 'test', '2015-01-01 01:01:01'), $form->getData());
    }

    /** @test */
    public function it_can_submit_form_generated_form_from_class_with_type_hints()
    {
        $form = $this->generator->generate(ObjectWithTypeHinting::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertEquals(new ObjectWithTypeHinting('1', 'test', new \DateTime('2015-01-01 01:01:01')), $form->getData());
    }

    /** @test */
    public function it_can_submit_form_generated_form_from_class_with_phpdoc_annotations()
    {
        $form = $this->generator->generate(ObjectWithPhpDocMetadata::class);

        $form->submit($this->validFormData());

        $this->assertThatFormWasSubmittedWithSuccess($form);
        $this->assertEquals(new ObjectWithPhpDocMetadata(1, 'test', new \DateTime('2015-01-01 01:01:01')), $form->getData());
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
            'propertyInteger'  => 1,
            'propertyString'   => 'test',
            'propertyDateTime' => '2015-01-01 01:01:01',
        ];
    }
}
