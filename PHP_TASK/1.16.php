<?php

for ($n = 6; $n <= 9999; $n++) {
    $sum = 0;

    if ($n % 2 == 0) {
        //echo $n . ' - четное число <br>';
        //$startI = 2;
        $inc = 1; //increment - прирост
        $maxDiv = (int)($n / 2);
    } else {
        //echo $n . ' - НЕ четное число <br>';
        //$startI = 3;
        $inc = 2; //increment - прирост
        $maxDiv = (int)($n / 3);
    }

    for ($i = 1; $i <= $maxDiv; $i += $inc) {
        if ($n % $i == 0) {
            $sum += $i;
        }
        if ($sum > $n) {
            //echo '<hr> ПЕРЕБОР: '.$n.'<hr>';
            continue 2;
        }
    }
    if ($sum == $n) {
        echo '<hr>'.$n.' = '.$sum .'<hr>';
        //continue 2;
    }
}