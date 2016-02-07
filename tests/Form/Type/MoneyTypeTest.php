<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Form\Type;

use Lzakrzewski\SymfonyFormGenerator\Form\Type\MoneyType;
use Money\Currency;
use Money\Money;

class MoneyTypeTest extends FormTypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new MoneyType());

        $form->submit('100 USD');

        $expected = new Money(10000, new Currency('USD'));
        $this->assertTrue($form->isValid());
        $this->assertTrue($expected->equals($form->getData()));
    }

    /** @test */
    public function it_does_not_submit_invalid_data()
    {
        $form = $this->factory->create(new MoneyType());

        $form->submit('xxxxx');

        $this->assertFalse($form->isValid());
    }
}
