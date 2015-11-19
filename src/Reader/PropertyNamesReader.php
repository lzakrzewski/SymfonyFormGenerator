<?php

namespace Lucaszz\SymfonyGenericForm\Reader;

class PropertyNamesReader
{
    /**
     * @param $object
     *
     * @return array
     */
    public function read($object)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException(sprintf('Unable to read property names on non-object, %s given.', gettype($object)));
        }

        return $this->propertyNames($object);
    }

    private function propertyNames($object)
    {
        $names = [];
        $refl  = new \ReflectionClass($object);

        foreach ($refl->getProperties() as $property) {
            $names[] = $property->getName();
        }

        return $names;
    }
}
