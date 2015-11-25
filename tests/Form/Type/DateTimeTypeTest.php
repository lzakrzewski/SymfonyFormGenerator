<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Form\Type;

use Lucaszz\SymfonyGenericForm\Form\Type\DateTimeType;
use Symfony\Component\Form\Test\TypeTestCase;

class DateTimeTypeTest extends TypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new DateTimeType());

        $form->submit('2010-06-02 01:01:01');

        $this->assertDateTimeEquals(new \DateTime('2010-06-02 01:01:01'), $form->getData());
    }
}
