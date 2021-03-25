<?php
session_start();
require ("../../data/db/db.php");
require ("../../data/class/jdf.php");

$code=$_SESSION["exam"];
$usern=$_SESSION["user"];

$dat=$connection->prepare("select * from exam where code='$code'");
$dat->execute();
$re=$dat->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["q-type-show"])){
if ($re[0]["s"]==1){
    echo "1";
}
}


if (isset($_POST["addedit1"])){

    $add1g=htmlspecialchars($_POST["add1g"]);
    $add11=htmlspecialchars($_POST["add11"]);
    $add12=htmlspecialchars($_POST["add12"]);
    $add13=htmlspecialchars($_POST["add13"]);
    $add14=htmlspecialchars($_POST["add14"]);
    $ad1c=htmlspecialchars($_POST["ad1c"]);

    $a=$add11."-".$add12."-".$add13."-".$add14;
    $code2=$_SESSION["add_edit"];
    $dat2=$connection->prepare("UPDATE `qu` SET `q`='$add1g',`a`='$a',`c`='$ad1c' WHERE id='$code2'");
    $dat2->execute() or die("0");
    echo "1";
}
if (isset($_POST["addedit2"])){

    $add1g=htmlspecialchars($_POST["q2"]);

    $code2=$_SESSION["add_edit"];
    $dat2=$connection->prepare("UPDATE `qu` SET `q`='$add1g' WHERE id='$code2'");
    $dat2->execute() or die("0");
    echo "1";
}


if (isset($_POST["add1"])){
    $add1g=htmlspecialchars($_POST["add1g"]);
    $add11=htmlspecialchars($_POST["add11"]);
    $add12=htmlspecialchars($_POST["add12"]);
    $add13=htmlspecialchars($_POST["add13"]);
    $add14=htmlspecialchars($_POST["add14"]);
    $ad1c=htmlspecialchars($_POST["ad1c"]);

    $a=$add11."-".$add12."-".$add13."-".$add14;

    $dat2=$connection->prepare("INSERT INTO `qu`(`id`, `code`, `q`, `a`,type,c) VALUES (null ,'$code','$add1g','$a','1','$ad1c')");
    $dat2->execute() or die("0");
    echo "1";
}


if (isset($_POST["add2"])){
    $q2=htmlspecialchars($_POST["q2"]);

    $dat3=$connection->prepare("INSERT INTO `qu`(`id`, `code`, `q`, `a`,type,c) VALUES (null ,'$code','$q2','','2','')");
    $dat3->execute() or die("0");
    echo "1";
}

if ($_POST["ref"]){
$code=$_SESSION["exam"];
$data3=$connection->prepare("select * from qu where code='$code'");
$data3->execute();
$result3=$data3->fetchAll(PDO::FETCH_ASSOC);
foreach ($result3 as $re) {
    echo "<div class=\"w3-card-4\"style=\"margin-top: 10px;\">";
    echo "<div class=\"w3-container w3-light-grey\">";
    echo "<h3 class=\"d-inline-block\">" . $re["q"] . "</h3>";
    echo "<a href=\"op/edit.php?id=".$re["id"]."\"id=\"del-" . $re["id"], "\" class=\"float-left d-inline-block edit\"style=\"margin-top: 15px;\"><i class=\"fas fa-pencil-alt\">ویرایش</i></a>";
    echo "<a href=\"op/del.php?id=".$re["id"]."\"id=\"edit-'" . $re["id"] . "\" class=\"float-left d-inline-block del\"style=\"margin-top: 15px;margin-left: 5px;\"><i class=\"fas fa-trash-alt\">حذف</i></a>";
    echo "</div>";
    echo "<div class=\"w3-container\">";
    if ($re["type"] == 1) {
        $a = explode("-", $re["a"]);
        $c = $re["c"];
        $c = $c - 1;
        $a2 = $a[$c];
        $a2 = "<p class=''><i class='fas fa-check'>" . $a2 . "</i></p>";
        $a[$c] = $a2;
        echo "<p>" . $a[0] . "</p>";
        echo "<p>" . $a[1] . "</p>";
        echo "<p>" . $a[2] . "</p>";
        echo "<p>" . $a[3] . "</p>";
    }
    echo " </div>";
    echo " </div>";
}

}




if (isset($_POST["date_time"])){
    $dates=htmlspecialchars($_POST["dates"]);
    $datee=htmlspecialchars($_POST["datee"]);
    $times=htmlspecialchars($_POST["times"]);
    //$timee2=$_POST["timee"];
    $ok=htmlspecialchars($_POST["ok"]);

    $time=$times."-".$ok;
    $date=$dates."-".$datee;

    $dat4=$connection->prepare("UPDATE `exam` SET `date`='$date',`time`='$time' WHERE code='$code' ");
    $dat4->execute();
}

$dat5=$connection->prepare("select * from exam where code='$code'");
$dat5->execute();
$res5=$dat5->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST["set_time_date"])){


if ($res5[0]["time"]!="" && $res5[0]["date"]!="") {
    $time_show = explode("-", $res5[0]["time"]);
    $date_show = explode("-", $res5[0]["date"]);

    $time_show[0] = $time_show[0] . ":00";
    $time_show[1] = $time_show[1] . ":00";
    $date_show[0] = jdate("o/m/d", $date_show[0]);
    $date_show[1] = jdate("o/m/d", $date_show[1]);

    echo "شروع: " . $date_show[0] . "  " . $time_show[0] . "  پایان: " . $date_show[1] . "  " . $time_show[1];
}else
    echo "تاریخ تنظیم نشده است. ";
}


if (isset($_POST["auto_s"])){

    if ($res5[0]["s"]==0) {
        $dat6 = $connection->prepare("UPDATE `exam` SET s='1' where code='$code'");
        $dat6->execute();
    }
    if ($res5[0]["s"]==1) {
        $dat7 = $connection->prepare("UPDATE `exam` SET s='0' where code='$code'");
        $dat7->execute();
    }


}


if (isset($_POST["new_a"])){
    $_SESSION["exam"]=null;
}



if (isset($_POST["creatcode"])){
    $creat_code_name=htmlspecialchars($_POST["name"]);
    $creat_code_code=htmlspecialchars($_POST["code"]);

    $dat8=$connection->prepare("INSERT INTO `accesscode`(`id`, `accessname`, `excode`, `code`, `name`) VALUES (null ,'','$code','$creat_code_code','$creat_code_name')");
    $dat8->execute();
}

if (isset($_POST["shcodeshow"])){
    $dat9=$connection->prepare("select * from accesscode where excode='$code'");
    $dat9->execute();
    $res9=$dat9->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul class=\"list-group rtl\"style='padding-left: 40px;'>";
    foreach ($res9 as $l9){
        echo "<li class='list-group-item'><a href='del_sh_code.php?id=".$l9["id"]."'><i class='far fa-trash-alt float-left del'></i></a>"."  نام: ".$l9["name"]."<p class='text-secondary'>"." کد: ".$l9["code"]."</p>"."</li>";
    }
    echo "</ul>";
}




            
