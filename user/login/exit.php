<?php
session_start();
$_SESSION["user"]=null;
$_SESSION["exam"]=null;
header("location: ../../index.php");
?>