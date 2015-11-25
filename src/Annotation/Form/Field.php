<?php

namespace Lucaszz\SymfonyGenericForm\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
final class Field
{
    public $value;

    public $name;

    public $options = [];
}
