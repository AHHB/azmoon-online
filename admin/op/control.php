<?php

session_start();
require ("../../data/db/db.php");

if (isset($_POST["usdel"])){
    $us_id=explode("-",$_POST["id"]);
    $dat1=$connection->prepare("DELETE FROM `users` WHERE id='$us_id[1]'");
    $dat1->execute();
}

if (isset($_POST["call"])){
    $call_name=htmlspecialchars($_POST["name"]);
    $call_email=htmlspecialchars($_POST["email"]);
    $call_text=htmlspecialchars($_POST["text"]);

    $dat2=$connection->prepare("INSERT INTO `massage`(`id`, `name`, `email`, `text`,sh) VALUES (null ,'$call_name','$call_email','$call_text','0')");
    $dat2->execute();
}