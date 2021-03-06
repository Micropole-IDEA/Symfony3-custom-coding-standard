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

use PHP_CodeSniffer\Files\File;

if (class_exists('\PHP_CodeSniffer\Sniffs\AbstractScopeSniff', true) === false) {
    throw new \PHP_CodeSniffer\Exceptions\RuntimeException(
        'Class \PHP_CodeSniffer\Sniffs\AbstractScopeSniff not found'
    );
}

/**
 * Verifies that class members have scope modifiers.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Symfony3Custom-coding-standard
 * @author   Authors <Symfony3Custom-coding-standard@escapestudios.github.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class Symfony3Custom_Sniffs_Scope_MethodScopeSniff
    extends \PHP_CodeSniffer\Sniffs\AbstractScopeSniff
{
    /**
     * Constructs a Symfony3Custom_Sniffs_Scope_MethodScopeSniff.
     */
    public function __construct()
    {
        parent::__construct(array(T_CLASS), array(T_FUNCTION));

    }

    /**
     * Processes the function tokens within the class.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where this token was found.
     * @param int                         $stackPtr  The position where the token was found.
     * @param int                         $currScope The current scope opener token.
     *
     * @return void
     */
    protected function processTokenWithinScope(
        \PHP_CodeSniffer\Files\File $phpcsFile,
        $stackPtr,
        $currScope
    ) {
        $tokens = $phpcsFile->getTokens();

        $methodName = $phpcsFile->getDeclarationName($stackPtr);
        if ($methodName === null) {
            // Ignore closures.
            return;
        }

        $modifier = $phpcsFile->findPrevious(
            \PHP_CodeSniffer\Util\Tokens::$scopeModifiers,
            $stackPtr
        );

        if (($modifier === false)
            || ($tokens[$modifier]['line'] !== $tokens[$stackPtr]['line'])
        ) {
            $error = 'No scope modifier specified for function "%s"';
            $data  = array($methodName);
            $phpcsFile->addError($error, $stackPtr, 'Missing', $data);
        }

    }

    /**
     * Processes a token that is found within the scope that this test is
     * listening to.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where this token was found.
     * @param int                         $stackPtr  The position in the stack where this
     *                                               token was found.
     *
     * @return void
     */
    protected function processTokenOutsideScope(File $phpcsFile, $stackPtr)
    {

    }//end processTokenOutsideScope()
}
