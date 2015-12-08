# Type hint guess

Form generator can generate form fields basing on constructor type hints:

Currently supported type hints:
 - `array` with mapped `generator_array` form type,
 - `\DateTime` with mapped `generator_datetime` form type,
 - `\Ramsey\Uuid\UuidInterface` with mapped `generator_uuid` form type,
 - `\Money\Money` with mapped `generator_money` form type.
 
 **Notice** for properly generating form type basing on constructor types, every properties should have the same name as constructor's arguments. 