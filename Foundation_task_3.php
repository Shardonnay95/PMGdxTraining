<?php

class Palindrome {

    public static function isPalindrome($Word) {
        $LowerCaseWordStr = strtolower($Word);
        $SanitizedWordStr = preg_replace('/\s+/', '', $LowerCaseWordStr);
        $ReversedWordStr = strrev($SanitizedWordStr);

        return $SanitizedWordStr === $ReversedWordStr;
    }
}

$InputWordStr = 'Never Odd Or Even';

if (Palindrome::isPalindrome($InputWordStr)) {
    echo 'Palindrome';
} else {
    echo 'Not palindrome';
}

?>