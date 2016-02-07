<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Form\Type;

use Lzakrzewski\SymfonyFormGenerator\Form\Type\DateTimeType;

class DateTimeTypeTest extends FormTypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new DateTimeType());

        $form->submit('2010-06-02 01:01:01');

        $this->assertTrue($form->isValid());
        $this->assertDateTimeEquals(new \DateTime('2010-06-02 01:01:01'), $form->getData());
    }

    /** @test */
    public function it_does_not_submit_invalid_data()
    {
        $form = $this->factory->create(new DateTimeType());

        $form->submit('20100602-01-01-01');

        $this->assertFalse($form->isValid());
    }
}
