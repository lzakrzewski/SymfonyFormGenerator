<?php

namespace Lzakrzewski\SymfonyFormGenerator\Annotation\Form;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
final class Field
{
    public $type;

    public $options = [];
}
