<?php

namespace Lucaszz\SymfonyGenericForm\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget'      => 'single_text',
            'format'      => "Y-m-d H:i:s",
        ]);
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'datetime';
    }

    public function getName()
    {
        return 'generic_datetime';
    }
}