<?php

function generateFibonacciSequence($LimitInt) {
    $FibonacciArr = [];
    $CurrentInt = 0;
    $NextInt = 1;

    while ($CurrentInt <= $LimitInt) {
        array_push($FibonacciArr, $CurrentInt);
        $TempInt = $CurrentInt + $NextInt;
        $CurrentInt = $NextInt;
        $NextInt = $TempInt;
    }

    return $FibonacciArr;
}

$LimitInt = 0;
$FibonacciArr = generateFibonacciSequence($LimitInt);

foreach ($FibonacciArr as $FibonacciNumberInt) {
    echo $FibonacciNumberInt . PHP_EOL;
}

?>
