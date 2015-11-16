<?php

namespace Lucaszz\SymfonyGenericFormType;

class Generator
{
    /**
     * @param $data
     *
     * @throws \InvalidArgumentException
     */
    public function generate($data)
    {
        if (!is_object($data)) {
            throw new \InvalidArgumentException(sprintf('Unable to generate form type from non-object, %s given.', gettype($data)));
        }
    }
}
