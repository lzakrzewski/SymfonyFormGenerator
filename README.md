# Symfony Form Generator [![Build Status](https://travis-ci.org/Lucaszz/SymfonyFormGenerator.svg?branch=master)](https://travis-ci.org/Lucaszz/SymfonyFormGenerator)

This package adds feature for generating `symfony` forms "on the fly" basing on class metadata like:
 - type hints,
 - phpdoc comments,
 - validator annotations,
 - form annotations.
 
## Example

Object of given class:

```php
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
        $this->propertyBoolean  = $propertyBoolean;
        $this->propertyArray    = $propertyArray;
        $this->propertyInteger  = $propertyInteger;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUndefined = $propertyUndefined;
    }
}
```

will have `form` equivalent:

```php
///
```

## Documentation

Topics: 
- [Installation](https://not-existing.yet)
- [Supported value objects](https://not-existing.yet)
- [Form annotation guess](https://not-existing.yet)
- [PHPDoc comment guess](https://not-existing.yet)
- [Validator guess](https://not-existing.yet)
- [Type hint guess](https://not-existing.yet)
- [Custom mapping](https://not-existing.yet)