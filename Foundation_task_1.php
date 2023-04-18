
<?php

// Constants
define("SAMPLE_ARRAY_ARR", [1, 1, 1, 1, 1]);

function addAll($InputArr) {
    $TotalInt = 0;
    
    while (count($InputArr) > 0) {
        $TotalInt += array_sum($InputArr);
        array_shift($InputArr);
    }
    
    return $TotalInt;
}

$SampleArr = SAMPLE_ARRAY_ARR; // 5 + 4 + 3 + 2 + 1 = 15
echo addAll($SampleArr);
?>
