<?php

use Lucaszz\SymfonyFormGenerator\GeneratorFactory;
use Lucaszz\SymfonyFormGenerator\ObjectWithMixedMetadata;
use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;

$mapper = PropertyTypeToFormTypeMapper::withDefaultMappings();
$mapper->addMapping('Namespace\CustomType', 'custom_form_type');

$form = GeneratorFactory::createGenerator($mapper)
    ->generateFormBuilder(ObjectWithMixedMetadata::class)
    ->getForm();
