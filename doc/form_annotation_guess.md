# Form annotation guess

In case when your form for field of object need to be strict specified use `Form\Field` annotation.

## Examples
```php
<?php

namespace Lzakrzewski\SymfonyFormGenerator;

use Lzakrzewski\SymfonyFormGenerator\Annotation\Form;

class ObjectWithFormAnnotations
{
    /** 
     * @Form\Field("checkbox", options={"label"="Property Boolean"}) 
     */
    public $propertyBoolean;
    /** 
     * @Form\Field("generator_array", options={"label"="Property Array"}) 
     */
    public $propertyArray;
    /** 
     * @Form\Field("integer", options={"label"="Property Integer"}) 
     */
    public $propertyInteger;
    /** 
     * @Form\Field("number", options={"label"="Property Number"}) 
     */
    public $propertyNumber;
    /** 
     * @Form\Field("generator_string", options={"label"="Property String"}) 
     */
    public $propertyString;
    /** 
     * @Form\Field("generator_datetime", options={"label"="Property DateTime"}) 
     */
    public $propertyDateTime;
    /** 
     * @Form\Field("generator_uuid", options={"label"="Property Uuid"}) 
     */
    public $propertyUuid;
    /** 
     * @Form\Field("generator_money", options={"label"="Property Money"}) 
     */
    public $propertyMoney;
}
```