# Symfony Form Generator [![Build Status](https://travis-ci.org/lzakrzewski/SymfonyFormGenerator.svg?branch=master)](https://travis-ci.org/lzakrzewski/SymfonyFormGenerator) [![Coverage Status](https://coveralls.io/repos/github/lzakrzewski/SymfonyFormGenerator/badge.svg?branch=master)](https://coveralls.io/github/lzakrzewski/SymfonyFormGenerator?branch=master)

This package adds feature for generating `symfony` forms "on the fly" basing on class metadata like:
 - `Form` annotations,
 - type hints,
 - phpdoc comments,
 - validator annotations. 
 
Created forms are able to submit with raw data (`boolean`, `integer`, `string`, `array`, `real`, `double`, `float`).
 
## Example

Object of given class:

```php
use Lzakrzewski\SymfonyFormGenerator\Annotation\Form;
use Symfony\Component\Validator\Constraints as Assert;

class ObjectWithMixedMetadata
{
    /**
     * @var bool
     */
    public $propertyBoolean;

    /**
     * @Assert\Count(max="5")
     */
    public $propertyArray;

    /**
     * @Form\Field("integer", options={"label"="Property Integer"})
     */
    public $propertyInteger;

    public $propertyDateTime;

    public $propertyUndefined;

    public function __construct($propertyBoolean, $propertyArray, $propertyInteger, \DateTime $propertyDateTime, $propertyUndefined)
    {
        $this->propertyBoolean   = $propertyBoolean;
        $this->propertyArray     = $propertyArray;
        $this->propertyInteger   = $propertyInteger;
        $this->propertyDateTime  = $propertyDateTime;
        $this->propertyUndefined = $propertyUndefined;
    }
}
```
after:

```php
$form = GeneratorFactory::createGenerator()
    ->generateFormBuilder(ObjectWithMixedMetadata::class)
    ->getForm();
```

will have `form` equivalent:

```php
use Lzakrzewski\SymfonyFormGenerator\Form\Type\GeneratorFormType;
use Lzakrzewski\SymfonyFormGenerator\ObjectWithMixedMetadata;
use Symfony\Component\Form\Forms;

Forms::createFormFactory()->createBuilder()
    ->create('form', new GeneratorFormType(ObjectWithMixedMetadata::class))
    ->add('propertyBoolean', 'checkbox')
    ->add('propertyArray', 'generator_array')
    ->add('propertyInteger', 'integer')
    ->add('propertyDateTime', 'generator_datetime')
    ->add('propertyUndefined', 'generator_string');
```
`generator_array` type extends `collection`,
`generator_datetime` type extends `datetime`,
`generator_string` type extends `text`.

`generator_*` types are custom form types for better support raw values.


## Documentation

Topics: 
- [Installation](doc/installation.md)
- [Usage](doc/usage.md)
- [Supported value objects](doc/value_objects.md)
- [Guess priorities](doc/guess_priorities.md)
- [Form annotation guess](doc/form_annotation_guess.md)
- [PHPDoc comment guess](doc/phpdoc_comment_guess.md)
- [Validator guess](doc/validator_guess.md)
- [Type hint guess](doc/type_hint_guess.md)
- [Custom mapping](doc/custom_mapping.md)