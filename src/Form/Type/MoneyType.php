<?php

namespace Lucaszz\SymfonyGenericForm\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoneyType extends AbstractType
{


    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generic_money';
    }
}