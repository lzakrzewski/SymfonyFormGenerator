<?php

namespace Lucaszz\SymfonyFormGenerator\Property;

class PropertyTypeToFormTypeMapper
{
    /** @var array */
    private $mappings;

    /**
     * @return PropertyTypeToFormTypeMapper
     */
    public static function withDefaultMappings()
    {
        $self = new self();

        $self->applyDefaultMappings();

        return $self;
    }

    public function applyDefaultMappings()
    {
        $this->addMapping('array', 'generator_array');
        $this->addMapping('string', 'generator_string');
        $this->addMapping('int', 'integer');
        $this->addMapping('integer', 'integer');
        $this->addMapping('float', 'number');
        $this->addMapping('double', 'number');
        $this->addMapping('real', 'number');
        $this->addMapping('bool', 'checkbox');
        $this->addMapping('boolean', 'checkbox');
        $this->addMapping('\DateTime', 'generator_datetime');
        $this->addMapping('\Ramsey\Uuid\UuidInterface', 'generator_uuid');
        $this->addMapping('\Money\Money', 'generator_money');
    }

    /**
     * @param string $variableType
     *
     * @return string
     */
    public function getFormType($variableType)
    {
        if (empty($this->mappings)) {
            return;
        }

        $variableType = $this->trim($variableType);

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
        $variableType = $this->trim($variableType);

        $this->mappings[$variableType] = $formType;
    }

    private function trim($variableType)
    {
        if ($variableType[0] == '\\') {
            $variableType = ltrim($variableType, '\\');
        }

        return $variableType;
    }
}
