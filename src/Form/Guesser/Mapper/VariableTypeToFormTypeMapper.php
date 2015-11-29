<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser\Mapper;

class VariableTypeToFormTypeMapper
{
    /** @var array */
    private $mappings;

    /**
     * @return VariableTypeToFormTypeMapper
     */
    public static function withDefaultMappings()
    {
        $self = new self();

        $self->addMapping('string', 'text');
        $self->addMapping('int', 'integer');
        $self->addMapping('integer', 'integer');
        $self->addMapping('float', 'number');
        $self->addMapping('double', 'number');
        $self->addMapping('real', 'number');
        $self->addMapping('bool', 'number');
        $self->addMapping('boolean', 'number');
        $self->addMapping('\DateTime', 'generator_datetime');
        $self->addMapping('\Ramsey\Uuid\UuidInterface', 'generator_uuid');
        $self->addMapping('\Money\Money', 'generator_money');

        return $self;
    }

    /**
     * @param string $variableType
     *
     * @return string
     */
    public function getFormType($variableType)
    {
        $classes = array_filter(array_keys($this->mappings), function ($variableType) {
            return interface_exists($variableType) || class_exists($variableType);
        });

        foreach ($classes as $class) {
            if (is_subclass_of($variableType, $class)) {
                return $this->mappings[$class];
            }
        }

        if (isset($this->mappings[$variableType])) {
            return $this->mappings[$variableType];
        }
    }

    /**
     * @param string $variableType
     * @param string $formType
     */
    public function addMapping($variableType, $formType)
    {
        $this->mappings[$variableType] = $formType;
    }
}
