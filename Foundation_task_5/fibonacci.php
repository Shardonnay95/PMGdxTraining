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

if (isset($_POST['limit'])) {
    $LimitInt = (int)$_POST['limit'];
    $FibonacciArr = generateFibonacciSequence($LimitInt);

    foreach ($FibonacciArr as $FibonacciNumberInt) {
        echo $FibonacciNumberInt . PHP_EOL;
    }
}
?>