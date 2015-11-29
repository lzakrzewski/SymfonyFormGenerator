<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver\TypeGuessResolver;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag\VarTag;
use Symfony\Component\Form\FormTypeGuesserInterface;

class PHPDocTypeGuesser implements FormTypeGuesserInterface
{
    /** @var TypeGuessResolver */
    private $resolver;

    /**
     * @param TypeGuessResolver $resolver
     */
    public function __construct(TypeGuessResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        $propertyType = $this->readPropertyType($class, $property);

        if (null === $propertyType) {
            return;
        }

        return $this->resolver->resolve($propertyType);
    }

    /** {@inheritdoc} */
    public function guessRequired($class, $property)
    {
    }

    /** {@inheritdoc} */
    public function guessMaxLength($class, $property)
    {
    }

    /** {@inheritdoc} */
    public function guessPattern($class, $property)
    {
    }

    /** {@inheritdoc} */
    protected function readPropertyType($class, $property)
    {
        $propertyType = $this->readTypeOnProperty($class, $property);

        if (null === $propertyType) {
            return $this->readTypeOnConstructor($class, $property);
        }

        return $propertyType;
    }

    private function readTypeOnProperty($class, $property)
    {
        $reflectionProperty = new \ReflectionProperty($class, $property);
        $phpdoc             = new DocBlock($reflectionProperty->getDocComment());

        $varTags = $phpdoc->getTagsByName('var');

        if (empty($varTags)) {
            return;
        }

        if ($varTags[0] instanceof VarTag) {
            return $varTags[0]->getType();
        }

        return $varTags[0]->getContent();
    }

    private function readTypeOnConstructor($class, $property)
    {
        $reflectionClass = new \ReflectionClass($class);

        if (null !== $constructor = $reflectionClass->getConstructor()) {
            $phpdoc = new DocBlock($constructor->getDocComment());
            $params = $phpdoc->getTagsByName('param');

            foreach ($params as $param) {
                if (!$param instanceof ParamTag) {
                    continue;
                }

                $paramName = str_replace('$', '', $param->getVariableName());

                if ($paramName == $property) {
                    return $param->getType();
                }
            }
        }
    }
}
