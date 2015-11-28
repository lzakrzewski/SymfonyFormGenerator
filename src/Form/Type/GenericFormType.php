<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @todo move it directly to form
 */
class GenericFormType extends AbstractType
{
    /** @var string */
    private $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /** {@inheritdoc} */
    public function configureOptions(OptionsResolver $resolver)
    {
        $reflection = new \ReflectionClass($this->class);

        $resolver->setDefaults(
            [
                'compound'   => true,
                'data_class' => $this->class,
                'empty_data' => $reflection->newInstanceWithoutConstructor(),
            ]
        );
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generic_form';
    }
}
