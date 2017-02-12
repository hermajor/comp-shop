<?php

$n = 369;
$counter = 2; //+2 уже за единицу и самого себя

if ($n % 2 == 0){
    echo $n . ' - четное число <br>';
    $startI = 2;
    $inc = 1; //increment - прирост
    $maxDiv = (int)($n / 2);
} else {
    echo $n . ' - НЕ четное число <br>';
    $startI = 3;
    $inc = 2; //increment - прирост
    $maxDiv = (int)($n / 3);
    //echo $maxDiv.'<hr>';
}

for ($i = $startI; $i <= $maxDiv; $i += $inc){
    if ($n % $i == 0){
        echo $n . ' / ' . $i . ' = ' . ($n/$i). '<br>';
        $counter++;
    }
}

echo '<hr>ВСЕГО ДЕЛИТЕЛЕЙ: '.$counter;