<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd hh:mm:ss',
        ]);
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'datetime';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generic_datetime';
    }
}
