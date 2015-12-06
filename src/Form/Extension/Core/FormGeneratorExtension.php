<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Extension\Core;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\FormAnnotationTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\PropertyTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Type\DateTimeType;
use Lucaszz\SymfonyFormGenerator\Form\Type\MoneyType;
use Lucaszz\SymfonyFormGenerator\Form\Type\UuidType;
use Symfony\Component\Form\Extension\Core\CoreExtension as BaseCoreExtension;
use Symfony\Component\Form\FormTypeGuesserChain;

class FormGeneratorExtension extends BaseCoreExtension
{
    /** @var PropertyTypeToFormTypeMapper */
    private $mapper;

    /**
     * @param PropertyTypeToFormTypeMapper $mapper
     */
    public function __construct(PropertyTypeToFormTypeMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /** {@inheritdoc} */
    protected function loadTypes()
    {
        return array_merge(parent::loadTypes(), [new DateTimeType(), new UuidType(), new MoneyType()]);
    }

    /** {@inheritdoc} */
    protected function loadTypeGuesser()
    {
        return new FormTypeGuesserChain($this->getTypeGuessers());
    }

    private function getTypeGuessers()
    {
        $factory = new TypeGuessFactory();

        return [
            new PHPDocTypeGuesser($this->mapper, $factory),
            new HintTypeGuesser($this->mapper, $factory),
            new FormAnnotationTypeGuesser(),
        ];
    }
}
