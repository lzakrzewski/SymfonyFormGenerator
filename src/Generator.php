<?php

namespace Lucaszz\SymfonyGenericFormType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class Generator
{
    /** @var FormBuilderInterface */
    private $builder;

    /**
     * @param FormBuilderInterface $builder
     */
    public function __construct(FormBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param $data
     *
     * @throws \InvalidArgumentException
     *
     * @return FormInterface
     */
    public function generate($data)
    {
        if (!is_object($data)) {
            throw new \InvalidArgumentException(sprintf('Unable to generate form type from non-object, %s given.', gettype($data)));
        }

        return $this->builder
            ->create('form', null, ['compound' => true])
            ->add('text')
            ->add('text')
            ->add('text')
            ->add('text')
            ->getForm();
    }
}
