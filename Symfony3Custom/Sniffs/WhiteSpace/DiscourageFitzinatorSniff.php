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

/**
 * Symfony3Custom_Sniffs_WhiteSpace_DiscourageFitzinatorSniff.
 *
 * Throws warnings if a file contains trailing whitespace.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Symfony3Custom-coding-standard
 * @author   Authors <Symfony3Custom-coding-standard@escapestudios.github.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     https://github.com/escapestudios/Symfony3Custom-coding-standard
 */
class Symfony3Custom_Sniffs_WhiteSpace_DiscourageFitzinatorSniff
    implements \PHP_CodeSniffer\Sniffs\Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                   'JS',
                                   'CSS',
                                  );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_WHITESPACE);

    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile All the tokens found in the document.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Make sure this is trailing whitespace.
        $line = $tokens[$stackPtr]['line'];
        if (($stackPtr < count($tokens) - 1)
            && $tokens[($stackPtr + 1)]['line'] === $line
        ) {
            return;
        }

        if (strpos($tokens[$stackPtr]['content'], "\n") > 0
            || strpos($tokens[$stackPtr]['content'], "\r") > 0
        ) {
            $warning = 'Please trim any trailing whitespace';
            $phpcsFile->addWarning($warning, $stackPtr, uniqid());
        }
    }
}
