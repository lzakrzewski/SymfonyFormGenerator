<?php

namespace Lucaszz\SymfonyGenericForm\Reader;

class PropertyNamesReader
{
    /**
     * @param string $class
     *
     * @return array
     */
    public function read($class)
    {
        return $this->propertyNames($class);
    }

    private function propertyNames($class)
    {
        $names = [];
        $refl  = new \ReflectionClass($class);

        foreach ($refl->getProperties() as $property) {
            $names[] = $property->getName();
        }

        return $names;
    }
}
