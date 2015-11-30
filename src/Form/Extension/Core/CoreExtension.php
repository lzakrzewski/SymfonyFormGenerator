<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Extension\Core;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\FormAnnotationTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\VariableTypeToFormTypeMapper;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolverLegacy;
use Lucaszz\SymfonyFormGenerator\Form\Type\DateTimeType;
use Lucaszz\SymfonyFormGenerator\Form\Type\MoneyType;
use Lucaszz\SymfonyFormGenerator\Form\Type\UuidType;
use Symfony\Component\Form\Extension\Core\CoreExtension as BaseCoreExtension;
use Symfony\Component\Form\FormTypeGuesserChain;

class CoreExtension extends BaseCoreExtension
{
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

    private static function getTypeGuessers()
    {
        $resolver = new TypeGuessResolverLegacy();

        $mapper  = VariableTypeToFormTypeMapper::withDefaultMappings();
        $factory = new TypeGuessFactory();

        return [
            new PHPDocTypeGuesser($resolver),
            new HintTypeGuesser($mapper, $factory),
            new FormAnnotationTypeGuesser(),
        ];
    }
}
