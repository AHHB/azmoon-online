<?php
require ("../../data/db/db.php");
session_start();

$id=$_GET["id"];
$code=$_SESSION["exam"];

$dat=$connection->prepare("DELETE FROM `accesscode` WHERE id='$id'");
$dat->execute();

header("location: code_list.php?creat=".$code);