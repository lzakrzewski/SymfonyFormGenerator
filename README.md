# SymfonyGenericForm [![Build Status](https://travis-ci.org/Lucaszz/SymfonyGenericForm.svg?branch=master)](https://travis-ci.org/Lucaszz/SymfonyGenericForm)
Generic solution to create form types "on the fly" basing on class metadata.

#Todo 
- [ ] Rename to symfony FormGenerator
- [ ] Introduce custom Forms
- [ ] Rename form types (avoid "generic" word)
- [ ] Customizable mapping
- [x] HintTypeGuesser
- [x] PhpDocTypeGuesser
- [ ] ValidatorTypeGuesser
- [ ] Test for mixed metadata
- [ ] Test for validation annotation
- [ ] Readme

- [x] Support phpdoc only on constructor 

- SupportTypes:
    - [x] string  
    - [x] integer 
    - [ ] float/double/real 

- Support VO: 
    - [x] DateTime 
    - [x] Money 
    - [x] Uuid 