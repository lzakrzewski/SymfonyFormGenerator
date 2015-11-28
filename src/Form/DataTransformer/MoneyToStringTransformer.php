<?php

namespace Lucaszz\SymfonyFormGenerator\Form\DataTransformer;

use Money\Currency;
use Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MoneyToStringTransformer implements DataTransformerInterface
{
    /** {@inheritdoc} */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof Money) {
            throw new TransformationFailedException('Expected a \Money\Money');
        }

        return sprintf('%.2f %s', (int) $value->getAmount() / 100.0, $value->getCurrency()->getName());
    }

    /** {@inheritdoc} */
    public function reverseTransform($value)
    {
        try {
            $parts = explode(' ', $value);

            $amount   = isset($parts[0]) ? $parts[0] : null;
            $currency = isset($parts[1]) ? $parts[1] : null;

            $money = new Money((int) $amount * 100, new Currency($currency));
        } catch (\Exception $e) {
            throw new TransformationFailedException($e->getMessage());
        }

        return $money;
    }
}
