<?php

namespace Lucaszz\SymfonyFormGenerator\Guesser;

use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;
use phpDocumentor\Reflection\DocBlock;

class PHPDocGuesser implements FormTypeGuesser
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
    public function guess($class, $property)
    {
        $shortPropertyType = $this->readTypeOnProperty($class, $property);

        if (null === $shortPropertyType) {
            return;
        }

        $propertyType = $this->fullPropertyType($shortPropertyType, $class);

        $formType = $this->mapper->getFormType($propertyType);

        if (null === $formType) {
            return;
        }

        return Guess::withDefaultOptions($formType);
    }

    private function readTypeOnProperty($class, $property)
    {
        $reflectionProperty = new \ReflectionProperty($class, $property);
        $phpdoc             = new DocBlock($reflectionProperty->getDocComment());

        $varTags = $phpdoc->getTagsByName('var');

        if (empty($varTags)) {
            return;
        }

        return $varTags[0]->getContent();
    }

    private function fullPropertyType($shortPropertyType, $class)
    {
        $reflectionClass = new \ReflectionClass($class);

        $contextFactory = new \phpDocumentor\Reflection\Types\ContextFactory();
        $context        = $contextFactory->createFromReflector($reflectionClass);

        $typeResolver = new \phpDocumentor\Reflection\TypeResolver();
        $type         = $typeResolver->resolve($shortPropertyType, $context);

        if (null !== $type) {
            if (class_exists((string) $type) || interface_exists((string) $type)) {
                return (string) $type;
            }
        }

        return $shortPropertyType;
    }
}
