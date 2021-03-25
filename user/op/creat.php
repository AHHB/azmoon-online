<?php
session_start();
require ("../../data/db/db.php");

if (isset($_POST["cname"])){
    $userna=$_SESSION["user"];
    $cname=$_POST["cname"];

    $code=date("dhs");

    $da=$connection->prepare("INSERT INTO `exam`(`id`, `name`, `date`, `time`, `num`, `t`, `s`, `username`, `code`, `end`) VALUES (null ,'$cname','','','0','0','0','$userna','$code','0')");
    $da->execute() or die("0");

    $_SESSION["exam"]=$code;

    echo "1";
}