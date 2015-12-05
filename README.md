# SymfonyFormGenerator [![Build Status](https://travis-ci.org/Lucaszz/SymfonyFormGenerator.svg?branch=master)](https://travis-ci.org/Lucaszz/SymfonyFormGenerator)
Generic solution to create form types "on the fly" basing on class metadata.

## Todo 
- [x] Add travis testing for different `symfony/form` component version,
- [ ] PhpDoc guesser should have more test cases,
- [x] `Generator::generate` => `Generator::generateFormBuilder`,
- [x] Doctrine annotations for requirements,
- [ ] Write test for real/double/float properties,
- [ ] Write test for `Assert` annotations,
- [ ] Write test for private properties,
- [ ] Write test for mixed metadata,
- [ ] Readme.

## Readme todo
- [ ] Installation,
- [ ] Usage,
- [ ] Generate from PHPdoc metadata,
- [ ] Generate from type hinting,
- [ ] Generate from `Form` annotation,
- [ ] Custom variable types.