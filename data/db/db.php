<?php
$host='localhost';
$user='root';
$password='';
$table='azmoon';

$cdb=mysqli_connect($host,$user,$password,$table);

mysqli_query($cdb, "SET NAMES utf8");
mysqli_query($cdb,"SET character_set_connection='utf 8' ");


$connection = new PDO("mysql:host=localhost;dbname=azmoon",$user,$password);

$connection->exec("SET NAMES utf8");
$connection->exec("SET character_set_connection='utf 8' ");


if(mysqli_connect_error()){
    echo ":مشکلی در اتصال به دیتابیس پیش آمده است".mysqli_connect_error();
}

function built(){
    echo " "."version:1.4.0"." ";
}