<?php

namespace Lucaszz\SymfonyFormGenerator\Tests\Form\Type;

use Lucaszz\SymfonyFormGenerator\Form\Type\ArrayType;

class ArrayTypeTest extends FormTypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new ArrayType());

        $form->submit(['test']);

        $this->assertTrue($form->isValid());
        $this->assertEquals(['test'], $form->getData());
    }

    /** @test */
    public function it_does_not_submit_invalid_data()
    {
        $form = $this->factory->create(new ArrayType());

        $form->submit(1245);

        $this->assertFalse($form->isValid());
    }
}
