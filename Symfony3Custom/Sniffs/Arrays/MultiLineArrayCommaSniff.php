<?php
/**
 * This file is part of the Symfony3Custom-coding-standard (phpcs standard)
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer-Symfony3Custom
 * @author   wicliff wolda <dev@bloody-wicked.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @version  GIT: master
 * @link     https://github.com/escapestudios/Symfony3Custom-coding-standard
 */

/**
 * Symfony3Custom_Sniffs_WhiteSpace_MultiLineArrayCommaSniff.
 *
 * Throws warnings if the last item in a multi line array does not have a
 * trailing comma
 *
 * @category PHP
 * @package  PHP_CodeSniffer-Symfony3Custom
 * @author   wicliff wolda <dev@bloody-wicked.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @link     https://github.com/escapestudios/Symfony3Custom-coding-standard
 */
class Symfony3Custom_Sniffs_Arrays_MultiLineArrayCommaSniff
    implements \PHP_CodeSniffer\Sniffs\Sniff
{
    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                  );

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_ARRAY,
                T_OPEN_SHORT_ARRAY,
               );

    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $open   = $tokens[$stackPtr];

        if ($open['code'] === T_ARRAY) {
            $closePtr = $open['parenthesis_closer'];
        } else {
            $closePtr = $open['bracket_closer'];
        }

        if ($open['line'] <> $tokens[$closePtr]['line']) {
            $lastComma = $phpcsFile->findPrevious(T_COMMA, $closePtr);

            while ($lastComma < $closePtr -1) {
                $lastComma++;

                if ($tokens[$lastComma]['code'] !== T_WHITESPACE
                    && $tokens[$lastComma]['code'] !== T_COMMENT
                ) {
                    $phpcsFile->addError(
                        'Add a comma after each item in a multi-line array',
                        $stackPtr,
                        'Invalid'
                    );
                    break;
                }
            }
        }

    }

}
