<?php

function fibonacciRecursive($NthInt) {
    if ($NthInt === 0) {
        return 0;
    }
    if ($NthInt === 1) {
        return 1;
    }
    return fibonacciRecursive($NthInt - 1) + fibonacciRecursive($NthInt - 2);
}

function generateFibonacciSequence($LimitInt) {
    $FibonacciArr = [];
    $CurrentInt = 0;

    while (true) {
        $FibonacciNumberInt = fibonacciRecursive($CurrentInt);
        if ($FibonacciNumberInt > $LimitInt) {
            break;
        }
        array_push($FibonacciArr, $FibonacciNumberInt);
        $CurrentInt++;
    }

    return $FibonacciArr;
}

$LimitInt = 75;
$FibonacciArr = generateFibonacciSequence($LimitInt);

foreach ($FibonacciArr as $FibonacciNumberInt) {
    echo $FibonacciNumberInt . PHP_EOL;
}

?>
