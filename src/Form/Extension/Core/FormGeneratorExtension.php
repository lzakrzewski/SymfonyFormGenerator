<?php

namespace Lzakrzewski\SymfonyFormGenerator\Form\Extension\Core;

use Lzakrzewski\SymfonyFormGenerator\Form\Type\ArrayType;
use Lzakrzewski\SymfonyFormGenerator\Form\Type\DateTimeType;
use Lzakrzewski\SymfonyFormGenerator\Form\Type\MoneyType;
use Lzakrzewski\SymfonyFormGenerator\Form\Type\StringType;
use Lzakrzewski\SymfonyFormGenerator\Form\Type\UuidType;
use Symfony\Component\Form\Extension\Core\CoreExtension as BaseCoreExtension;

class FormGeneratorExtension extends BaseCoreExtension
{
    /** {@inheritdoc} */
    protected function loadTypes()
    {
        return array_merge(
            parent::loadTypes(),
            [
                new StringType(),
                new ArrayType(),
                new DateTimeType(),
                new UuidType(),
                new MoneyType(),
            ]
        );
    }
}
