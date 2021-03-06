<?php

/**
 * This file is part of the Symfony3Custom-coding-standard (phpcs standard)
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Symfony3Custom-coding-standard
 * @author   Authors <Symfony3Custom-coding-standard@escapestudios.github.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     https://github.com/escapestudios/Symfony3Custom-coding-standard
 */

if (class_exists('\PHP_CodeSniffer\Tokenizers\Comment', true) === false) {
    $error = 'Class \PHP_CodeSniffer\Tokenizers\Comment not found';
    throw new \PHP_CodeSniffer\Exceptions\RuntimeException($error);
}

if (class_exists('\PHP_CodeSniffer\Standards\PEAR\Sniffs\Commenting\ClassCommentSniff', true) === false) {
    $error = 'Class \PHP_CodeSniffer\Standards\PEAR\Sniffs\Commenting\ClassCommentSniff not found';
    throw new \PHP_CodeSniffer\Exceptions\RuntimeException($error);
}

/**
 * Parses and verifies the doc comments for classes.
 *
 * Verifies that :
 * <ul>
 *  <li>A doc comment exists.</li>
 *  <li>There is a blank newline after the short description.</li>
 *  <li>There is a blank newline between the long and short description.</li>
 *  <li>There is a blank newline between the long description and tags.</li>
 *  <li>Check the order of the tags.</li>
 *  <li>Check the indentation of each tag.</li>
 *  <li>Check required and optional tags and the format of their content.</li>
 * </ul>
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Symfony3Custom-coding-standard
 * @author   Authors <Symfony3Custom-coding-standard@escapestudios.github.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class Symfony3Custom_Sniffs_Commenting_ClassCommentSniff
    extends \PHP_CodeSniffer\Standards\PEAR\Sniffs\Commenting\ClassCommentSniff
{
    /**
     * Tags in correct order and related info.
     *
     * @var array
     */
    protected $tags = array(
        'category' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'precedes @package',
        ),
        'package' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @category',
        ),
        'subpackage' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @package',
        ),
        'author' => array(
            'required' => false,
            'allow_multiple' => true,
            'order_text' => 'follows @subpackage (if used) or @package',
        ),
        'copyright' => array(
            'required' => false,
            'allow_multiple' => true,
            'order_text' => 'follows @author',
        ),
        'license' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @copyright (if used) or @author',
        ),
        'version' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @license',
        ),
        'link' => array(
            'required' => false,
            'allow_multiple' => true,
            'order_text' => 'follows @version',
        ),
        'see' => array(
            'required' => false,
            'allow_multiple' => true,
            'order_text' => 'follows @link',
        ),
        'since' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @see (if used) or @link',
        ),
        'deprecated' => array(
            'required' => false,
            'allow_multiple' => false,
            'order_text' => 'follows @since (if used) or @see (if used) or @link',
        ),
    );
}
