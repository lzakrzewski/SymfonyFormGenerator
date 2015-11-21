<?php

namespace Lucaszz\SymfonyGenericForm\Form\Guesser;

use phpDocumentor\Reflection\DocBlock;

class PHPDocTypeGuesser extends GenericTypeGuesser
{
    /** {@inheritdoc} */
    protected function readPropertyType($class, $property)
    {
        $reflectionProperty = new \ReflectionProperty($class, $property);
        $phpdoc             = new DocBlock($reflectionProperty->getDocComment());

        $varTags = $phpdoc->getTagsByName('var');

        if (empty($varTags)) {
            return;
        }

        return $varTags[0]->getContent();
    }
}
