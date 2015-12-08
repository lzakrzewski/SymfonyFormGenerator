# Usage 
```php
        $form = GeneratorFactory::createGenerator()
            ->generateFormBuilder(ObjectWithMixedMetadata::class)
            ->getForm();
            
        $form->submit([
            'propertyBoolean' => true,
            'propertyArray' => ['test'],
            'propertyInteger' => 1,
            'propertyDateTime' => '2016-01-01 00:00:00',
            'propertyUndefined' => 'test',
        ]);
        
        //Do your own logic there...
```
