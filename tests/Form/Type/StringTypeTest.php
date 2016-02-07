<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Form\Type;

use Lzakrzewski\SymfonyFormGenerator\Form\Type\StringType;

class StringTypeTest extends FormTypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new StringType());

        $form->submit('test123');

        $this->assertTrue($form->isValid());
        $this->assertEquals('test123', $form->getData());
    }

    /** @test */
    public function it_does_not_submit_invalid_data()
    {
        $form = $this->factory->create(new StringType());

        $form->submit(new \stdClass());

        $this->assertFalse($form->isValid());
    }
}
