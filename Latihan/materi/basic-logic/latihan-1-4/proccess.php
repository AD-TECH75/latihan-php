<?php
require_once './lib/calculator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $operator = $_POST['operator'];

        if (is_numeric($number1) && is_numeric($number2)) {
            switch ($operator) {
                case 'plus':
                    $resultnumber = plus($number1, $number2);
                    break;
                case 'minus':
                    $resultnumber = minus($number1, $number2);
                    break;
                case 'multiplied':
                    $resultnumber = multiplied($number1, $number2);
                    break;
                case 'devide':
                    if ($number2 == 0) {
                        header("location: ./index.php");
                        exit();
                    } else {
                        $resultnumber = devide($number1, $number2);
                    }
                    break;
            }
        }

        include 'result.php';
    } else {
        header('location: ./index.php');
        exit();
    }
} else {
    header('location: ./index.php');
    exit();
}
