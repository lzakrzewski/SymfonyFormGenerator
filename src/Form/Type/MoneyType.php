<?php

namespace Lucaszz\SymfonyGenericForm\Form\Type;

use Lucaszz\SymfonyGenericForm\Form\DataTransformer\MoneyToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MoneyType extends AbstractType
{
    /** {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new MoneyToStringTransformer());
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'text';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generic_money';
    }
}
