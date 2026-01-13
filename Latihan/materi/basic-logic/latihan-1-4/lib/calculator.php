<?php
function plus($number1, $number2){
    $result = $number1 + $number2;
    return $result;
}

function minus($number1, $number2){
    $result = $number1 - $number2;
    return $result;
}

function multiplied($number1, $number2){
    $result = $number1 * $number2;
    return $result;
}

function devide($number1, $number2){
    if ($number2 === 0) {
        header('location: ../index.php');
    } else {
        $result = $number1 / $number2;
        return $result;
    }
}
