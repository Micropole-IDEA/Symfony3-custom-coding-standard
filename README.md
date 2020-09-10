# Symfony3 Custom PHP CodeSniffer 3 Coding Standard

This is a fork of https://github.com/djoos/Symfony2-coding-standard
These are the Symfony2 standards, but tweaked to meet some needs we have in our CSB project, for example to comply with 
[PSR-12](https://github.com/php-fig/fig-standards/blob/master/proposed/extended-coding-style-guide.md) for PHP 7 and it's compatible with PHPCS 3

## Installation

### Composer

This standard can be installed with the [Composer](https://getcomposer.org/) dependency manager.

1. install with composer: 
```json
	composer require micropole-idea/symfony3-custom-coding-standard --dev
```

2. Add the coding standard to the PHP_CodeSniffer install path 

The path is relative to the php_codesniffer install path. This is important to make it work both in your vagrant, local machine and PHPStorm

        bin/phpcs --config-set installed_paths ../../micropole-idea/symfony3-custom-coding-standard

3. Check the installed coding standards for "Symfony3"

        bin/phpcs -i

4. Done!

       bin/phpcs --standard=Symfony3Custom /path/to/code
       
5. (optional) Set up PHPStorm

- configure code sniffer under Languages & Frameworks -> PHP -> Code Sniffer
- Go to Editor -> Inspections -> PHP Code sniffer, refresh the standards and select Symfony3Custom
       
## Customizations

The following adjustments have been made to the original standard:

In Sniff/WhiteSpace/AssignmentSpacingSniff:
- Added an exception for ```declare(strict_types=1);``` to comply with [PSR-12](https://github.com/php-fig/fig-standards/blob/master/proposed/extended-coding-style-guide.md#3-declare-statements-namespace-and-use-declarations) 

In Sniff/WhiteSpace/FunctionalClosingBraceSniff:
- copied from Squiz and adapted to have no blank line at the end of a function

In Sniff/Commenting/FunctionCommentSniff:
- check for 1 blank line above a docblock
- don't check docblocks for test and setUp methods (PHPunit, would be blank)
- do check protected and private methods for docblocks

In Sniff/NamingConventions/ValidClassNameSniff
- remove the abstract class name rule

In ruleset.xml
- Disabled the class comment rule
- Changed the concatenation spacing rule, for readability, to require 1 space around concatenation dot, instead of no spaces as the [Symfony](https://symfony.com/doc/current/contributing/code/standards.html#structure) standard requires.
- Re-enabled the blank line check from superfluousWhitespace (disabled in PSR-2)
       
