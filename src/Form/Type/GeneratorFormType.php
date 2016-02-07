<?php

namespace Lzakrzewski\SymfonyFormGenerator\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeneratorFormType extends AbstractType
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
                'csrf_protection' => false,
                'compound'        => true,
                'data_class'      => $this->class,
                'empty_data'      => $reflection->newInstanceWithoutConstructor(),
            ]
        );
    }

    /** {@inheritdoc} */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generator_form';
    }
}
