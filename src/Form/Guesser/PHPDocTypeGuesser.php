<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser;

use Lucaszz\SymfonyFormGenerator\Form\Guesser\Factory\TypeGuessFactory;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\FullClassName\FullClassNameReader;
use Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper\VariableTypeToFormTypeMapper;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;
use phpDocumentor\Reflection\DocBlock\Tag\VarTag;
use Symfony\Component\Form\FormTypeGuesserInterface;

class PHPDocTypeGuesser implements FormTypeGuesserInterface
{
    /** @var TypeGuessFactory */
    private $factory;
    /** @var VariableTypeToFormTypeMapper */
    private $mapper;

    /**
     * @param VariableTypeToFormTypeMapper $mapper
     * @param TypeGuessFactory             $factory
     */
    public function __construct(VariableTypeToFormTypeMapper $mapper, TypeGuessFactory $factory)
    {
        $this->factory = $factory;
        $this->mapper  = $mapper;
    }

    /** {@inheritdoc} */
    public function guessType($class, $property)
    {
        $propertyType = $this->readVariableType($class, $property);

        if (null === $propertyType) {
            return;
        }

        $variableType = (new FullClassNameReader())->read($propertyType, $class);

        $formType = $this->mapper->getFormType($variableType);

        if (null === $formType) {
            return;
        }

        return $this->factory->create($formType);
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
    protected function readVariableType($class, $property)
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
