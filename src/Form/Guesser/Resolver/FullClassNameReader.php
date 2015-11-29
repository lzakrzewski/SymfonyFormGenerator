<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Guesser\Resolver;

class FullClassNameReader
{
    /**
     * @param string $variableType
     * @param string $class
     *
     * @return string
     */
    public function read($variableType, $class)
    {
        if (interface_exists($variableType) || class_exists($variableType)) {
            return $variableType;
        }

        if (null !== $fullName = $this->readFullName($variableType, $class)) {
            return $fullName;
        }

        return $variableType;
    }

    private function readFullName($variableType, $class)
    {
        $reflectionClass = new \ReflectionClass($class);

        $contents = file_get_contents($reflectionClass->getFileName());

        if ($contents) {
            $classImports = $this->unParseClassImports($contents);

            foreach ($classImports as $classImport) {
                $fullName = $classImport.$variableType;
                if (interface_exists($fullName) || class_exists($fullName)) {
                    return $fullName;
                }
            }
        }

        return $variableType;
    }

    private function unParseClassImports($contents)
    {
        $tokens  = token_get_all($contents);
        $imports = [];

        foreach ($tokens as $key => $token) {
            if (isset($token[1]) && $token[1] == 'use') {
                $imports[] = $this->unParseSingleImport($key, $tokens);
            }

            if (isset($token[1]) && $token[1] == 'class') {
                break;
            }
        }

        return $imports;
    }

    private function unParseSingleImport($key, $tokens)
    {
        $importParts  = [];
        $tokenCounter = 0;

        while ($tokenCounter < 255) {
            ++$tokenCounter;

            $token = $tokens[$key + $tokenCounter];

            if ($token == ';') {
                break;
            }

            if (isset($token[1])) {
                $importParts[] = trim($token[1]);
            }
        }

        array_pop($importParts);

        return implode('', $importParts);
    }
}
