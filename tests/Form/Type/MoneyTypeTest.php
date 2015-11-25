<?php

namespace Lucaszz\SymfonyGenericForm\Tests\Form\Type;

use Lucaszz\SymfonyGenericForm\Form\Type\MoneyType;
use Money\Currency;
use Money\Money;
use Symfony\Component\Form\Test\TypeTestCase;

class MoneyTypeTest extends TypeTestCase
{
    /** @test */
    public function it_submits_valid_data()
    {
        $form = $this->factory->create(new MoneyType());

        $form->submit('100 USD');

        $expected = new Money(10000, new Currency('USD'));
        $this->assertTrue($expected->equals($form->getData()));
    }
}
