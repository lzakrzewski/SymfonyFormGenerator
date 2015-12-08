## PHPdoc comment guess

Form generator can generate form fields basing on phpdoc comments on class properties. 

Currently supported phpdoc types:
 - `bool`, `boolean` with mapped `checkbox` form type,
 - `int`, `integer` with mapped `integer` form type,
 - `float`, `double`, `real` with mapped `number` form type,
 - `string` with mapped `generator_string` form type,
 - `array` with mapped `generator_array` form type,
 - `\DateTime` with mapped `generator_datetime` form type,
 - `\Ramsey\Uuid\UuidInterface` with mapped `generator_uuid` form type,
 - `\Money\Money` with mapped `generator_money` form type.
 
 Custom value objects for e.g. `Namespace\CustomValueObjects` can be mapped to your own form type. See [Custom mapping](doc/custom_mapping.md).
 
 
 