<?php
function generateFibonacciSequence($LimitInt) {
    $FibonacciArr = [];
    $CurrentInt = 0;
    $NextInt = 1;

    while ($CurrentInt <= $LimitInt) {
        array_push($FibonacciArr, $CurrentInt); //push $CurrentInt to the $FibonacciArr array
        $TempInt = $CurrentInt + $NextInt; //calculate the next Fibonacci number
        $CurrentInt = $NextInt;
        $NextInt = $TempInt;
    }

    return $FibonacciArr;
}

//check if the 'limit' POST variable is set. If true, cast its value to an integer and store it in the $LimitInt variable.
if (isset($_POST['limit'])) {
    $LimitInt = (int)$_POST['limit'];
    $FibonacciArr = generateFibonacciSequence($LimitInt);

    //Iterate through the Fibonacci sequence stored in $FibonacciArr. For each iteration, output the current Fibonacci number 
    foreach ($FibonacciArr as $FibonacciNumberInt) {
        echo $FibonacciNumberInt . PHP_EOL;
    }
}
?>