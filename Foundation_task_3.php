<?php

class Palindrome {

    public static function isPalindrome($Word) {
        $LowerCaseWordStr = strtolower($Word);
        $Replace = array("/'/", "/\s/");
        $SanitizedWordStr = preg_replace($Replace, '', $LowerCaseWordStr);
        $ReversedWordStr = strrev($SanitizedWordStr);
        echo $SanitizedWordStr;
        return $SanitizedWordStr === $ReversedWordStr;
    }
}

$InputWordStr = "Don't nod";

if (Palindrome::isPalindrome($InputWordStr)) {
    echo 'Palindrome';
} else {
    echo 'Not palindrome';
}

?>