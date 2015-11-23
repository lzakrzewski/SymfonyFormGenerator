<?php

namespace Lucaszz\SymfonyGenericForm\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Uuid;

class UuidType extends AbstractType
{
    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'constraints' => [
                    new Uuid(['versions' => [Uuid::V4_RANDOM]]),
                ],
            ]
        );
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'text';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generic_uuid';
    }
}
