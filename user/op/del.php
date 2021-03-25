<?php
require ("../../data/db/db.php");

$id=$_GET["id"];

$dat=$connection->prepare("DELETE FROM `qu` WHERE id='$id'");
$dat->execute();

header("location: ../add.php");
?>