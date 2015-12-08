# Custom mapping 

There is class `\Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper` which map type of properties to form types.
`PropertyTypeToFormTypeMapper` is used for guess form type basing on:
 - PHPdoc comments,
 - Validator annotations,
 - Type hints,

## Default mapping:
| property type | form type |
|---|---|
| array | generator_array |
| string | generator_string |
| int | integer |
| integer | integer |
| float | number |
| double | number |
| real | number |
| bool | checkbox |
| boolean | checkbox |
| \DateTime | generator_datetime |
| \Ramsey\Uuid\UuidInterface | generator_uuid |
| \Money\Money | generator_money |

## Customize mapping
```php
use Lucaszz\SymfonyFormGenerator\GeneratorFactory;
use Lucaszz\SymfonyFormGenerator\ObjectWithMixedMetadata;
use Lucaszz\SymfonyFormGenerator\Property\PropertyTypeToFormTypeMapper;

$mapper = PropertyTypeToFormTypeMapper::withDefaultMappings();
$mapper->addMapping('Namespace\CustomType', 'custom_form_type');

$form = GeneratorFactory::createGenerator($mapper)
    ->generateFormBuilder(ObjectWithMixedMetadata::class)
    ->getForm();
```