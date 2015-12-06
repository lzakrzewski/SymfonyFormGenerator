<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArrayType extends AbstractType
{
    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_add' => true,
        ]);
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'collection';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generator_array';
    }
}
