<?php
require ("../../data/db/db.php");
session_start();
$code=$_SESSION["exam"];
if (isset($_POST["b_submit"])){
    $data6=$connection->prepare("UPDATE `exam` SET `end`='0' WHERE code='$code'");
    $data6->execute();
    mysqli_query($cdb,"UPDATE exam SET end='0' WHERE code='$code'");
    header("location: ../add.php");
}
if (isset($_POST["t_submit"])){
    $_SESSION["exam"]=null;
    header("location: ../user.php");
}
