<?php

namespace Lzakrzewski\SymfonyFormGenerator\Tests\Form\DataTransformer;

use Lzakrzewski\SymfonyFormGenerator\Form\DataTransformer\MoneyToStringTransformer;
use Lzakrzewski\SymfonyFormGenerator\Tests\UnitTestCase;
use Money\Money;

class MoneyToStringTransformerTest extends UnitTestCase
{
    /** @var MoneyToStringTransformer */
    private $transformer;

    /** @test */
    public function it_transforms_money_to_string()
    {
        $money = Money::USD(1000);

        $transformed = $this->transformer->transform($money);

        $this->assertEquals('10.00 USD', $transformed);
    }

    /** @test */
    public function it_transforms_null_to_string()
    {
        $transformed = $this->transformer->transform(null);

        $this->assertEquals('', $transformed);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function it_can_not_transform_non_money()
    {
        $this->transformer->transform(new \stdClass());
    }

    /** @test */
    public function it_reserve_transforms_string_to_money()
    {
        $transformed = $this->transformer->reverseTransform('10.00 USD');

        $this->assertMoneyEquals(Money::USD(1000), $transformed);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function it_can_not_reserve_transforms_invalid_uuid_string_to_uuid()
    {
        $this->transformer->reverseTransform('000 invalid-money');
    }

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->transformer = new MoneyToStringTransformer();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->transformer = null;
    }
}
