<?php


namespace Clarity\NotificationBundle\Message\Header;

/**
 * Class UnstructuredHeader
 * @package Clarity\NotificationBundle\Message\Header
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class UnstructuredHeader extends \Swift_Mime_Headers_UnstructuredHeader {

    /**
     * Get a token as an encoded word for safe insertion into headers.
     *
     * @param string  $token           token to encode
     * @param int     $firstLineOffset optional
     *
     * @return string
     */
    protected function getTokenAsEncodedWord($token, $firstLineOffset = 0)
    {
        // Adjust $firstLineOffset to account for space needed for syntax
        $charsetDecl = $this->getCharset();
        if (isset($this->_lang)) {
            $charsetDecl .= '*' . $this->_lang;
        }
        $encodingWrapperLength = strlen(
            '=?' . $charsetDecl . '?' . $this->getEncoder()->getName() . '??='
        );

        if ($firstLineOffset >= 75) { //Does this logic need to be here?
            $firstLineOffset = 0;
        }

        $encodedTextLines = explode("\r\n",
            $this->getEncoder()->encodeString(
                $token, $firstLineOffset, 75 - $encodingWrapperLength, $this->getCharset()
            )
        );

        if (strtolower($this->getCharset()) !== 'iso-2022-jp') { // special encoding for iso-2022-jp using mb_encode_mimeheader
            foreach ($encodedTextLines as $lineNum => $line) {
                $encodedTextLines[$lineNum] = '=?' . $charsetDecl .
                    '?' . $this->getEncoder()->getName() .
                    '?' . $line . '?=';
            }
        }

        return implode("", $encodedTextLines);
    }

} 