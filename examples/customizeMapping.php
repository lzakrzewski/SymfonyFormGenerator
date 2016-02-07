<?php

use Lzakrzewski\SymfonyFormGenerator\GeneratorFactory;
use Lzakrzewski\SymfonyFormGenerator\ObjectWithMixedMetadata;
use Lzakrzewski\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;

$mapper = PropertyTypeToFormTypeMapper::withDefaultMappings();
$mapper->addMapping('Namespace\CustomType', 'custom_form_type');

$form = GeneratorFactory::createGenerator($mapper)
    ->generateFormBuilder(ObjectWithMixedMetadata::class)
    ->getForm();
