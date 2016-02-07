# Usage 
```php
use Lzakrzewski\SymfonyFormGenerator\GeneratorFactory;
use Lzakrzewski\SymfonyFormGenerator\ObjectWithMixedMetadata;

$form = GeneratorFactory::createGenerator()
    ->generateFormBuilder(ObjectWithMixedMetadata::class)
    ->getForm();
    
$form->submit([
    'propertyBoolean'   => true,
    'propertyArray'     => ['test'],
    'propertyInteger'   => 1,
    'propertyDateTime'  => '2016-01-01 00:00:00',
    'propertyUndefined' => 'test',
]);
```

Generated form by default could be submit with raw data (`boolean`, `integer`, `string`, `array`, `real`, `double`, `float`).