# Installation 

## Requirements
```json
    "require": {
        "php": ">=5.5",
        "symfony/form": "~2.6",
        "symfony/validator": "~2.6",
        "doctrine/annotations": "~1.0",
        "phpdocumentor/reflection-docblock": "~2.0",
        "phpdocumentor/type-resolver": "~0.1"
    },
```

## Require with composer
Add to `composer.json`
```json
    "require": {
        "lzakrzewski/symfony-form-generator": "0.0.*@dev"
    },
```

And then:
```bash
composer.phar update "lzakrzewski/symfony-form-generator"
```