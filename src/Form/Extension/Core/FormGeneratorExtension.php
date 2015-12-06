<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Extension\Core;

use Lucaszz\SymfonyFormGenerator\Form\Type\DateTimeType;
use Lucaszz\SymfonyFormGenerator\Form\Type\MoneyType;
use Lucaszz\SymfonyFormGenerator\Form\Type\UuidType;
use Symfony\Component\Form\Extension\Core\CoreExtension as BaseCoreExtension;

class FormGeneratorExtension extends BaseCoreExtension
{
    /** {@inheritdoc} */
    protected function loadTypes()
    {
        return array_merge(parent::loadTypes(), [new DateTimeType(), new UuidType(), new MoneyType()]);
    }
}
