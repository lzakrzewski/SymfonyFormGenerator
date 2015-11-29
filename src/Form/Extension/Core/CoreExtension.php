<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Extension\Core;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\FormAnnotationTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\HintTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\PHPDocTypeGuesser;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
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
        $resolver = new TypeGuessResolver();

        return [
            new PHPDocTypeGuesser($resolver),
            new HintTypeGuesser($resolver),
            new FormAnnotationTypeGuesser($resolver),
        ];
    }
}
