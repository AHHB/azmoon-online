<?php
session_start();
require ("../../data/db/db.php");


if (isset($_POST["aeei"])){
    $aeei=$_POST["aeei"];
    $aeei2=explode("-",$aeei);
    $aeei3=$aeei2[1];

    $dat1=$connection->prepare("select * from exam where id='$aeei3'");
    $dat1->execute();
    $res1=$dat1->fetchAll(PDO::FETCH_ASSOC);


    $_SESSION["exam"]=$res1[0]["code"];
    header("location: add.php");
}

if (isset($_POST["aedi"])){
    $aedi=$_POST["aedi"];
    $aedi2=explode("-",$aedi);
    $aedi3=$aedi2[1];

    $dat2=$connection->prepare("DELETE FROM `exam` WHERE id='$aedi3'");
    $dat2->execute();
    $_SESSION["exam"]=null;
}


if (isset($_POST["sh"])){
    $shname=htmlspecialchars($_POST["name"]);
    $shlname=htmlspecialchars($_POST["lname"]);
    $excode=$_POST["excode"];
    $shcode=date("ymdhis");

    $shdata=$connection->prepare("INSERT INTO `sh`(`id`, `name`, `lname`, `code`, `excode`, `a`) VALUES (null ,'$shname','$shlname','$shcode','$excode','')");
    $shdata->execute();
    $_SESSION["sh"]=$shcode;
}


if (isset($_GET["sh2"])){
    $in_code=htmlspecialchars($_GET["in_code2"]);
    $excode=$_GET["excode"];

    $data4=$connection->prepare("select * from accesscode where excode='$excode'");
    $data4->execute();
    $result4=$data4->fetchAll(PDO::FETCH_ASSOC);

    $access_code="0";
    $shcode=date("ymdhis");

    foreach ($result4 as $l4){
        if ($l4["code"]==$in_code){
            $access_code=$l4["code"];
            $_SESSION["sh"]=$shcode;
            $_SESSION["sh2"]=$access_code;
            $in_name=$l4["name"];
            $shdata=$connection->prepare("INSERT INTO `sh`(`id`, `name`, `lname`, `code`, `excode`, `a`) VALUES (null ,'$in_name','$in_code','$shcode','$excode','')");
            $shdata->execute();
        }
    }
    if ($access_code=="0"){
        $_SESSION["sh"]=$shcode;
        $_SESSION["sh2"]="er";
        $shdata=$connection->prepare("INSERT INTO `sh`(`id`, `name`, `lname`, `code`, `excode`, `a`) VALUES (null ,'','','$shcode','$excode','')");
        $shdata->execute();
    }
}


if (isset($_POST["a1"])){
    $a1_id=$_POST["id"];
    $a1_id_e=explode("-",$a1_id);
    $sh_code=$_SESSION["sh"];
    $a1data1=$connection->prepare("select * from sh where code='$sh_code'");
    $a1data1->execute();
    $a1re1=$a1data1->fetchAll(PDO::FETCH_ASSOC);
    $a1_1=$a1re1[0]["a"];

    $a1_0="";
    $a1_p_0=explode("|",$a1_1);

    foreach ($a1_p_0 as $l1){
        $a1_p_1=explode("-",$l1);
        if ($a1_p_1[0]!=$a1_id_e[0]){
            $a1_0=$a1_0.$l1."|";
        }else{
            $a1_0=$a1_0.$a1_id."|";
        }
    }

    $a1data=$connection->prepare("UPDATE `sh` SET `a`='$a1_0' WHERE code='$sh_code'");
    $a1data->execute();

}


if (isset($_GET["mdel"])){
    $m_del_code2=$_GET["deel"];
    $m_del_code1=explode("-",$m_del_code2);
    $m_del_code=$m_del_code1[1];
    $dat8=$connection->prepare("DELETE FROM `exam` WHERE code='$m_del_code'");
    mysqli_query($cdb,"DELETE FROM `exam` WHERE code='$m_del_code'");
    $dat8->execute();
    $dat9=$connection->prepare("DELETE FROM `qu` WHERE code='$m_del_code'");
    $dat9->execute();
    $dat10=$connection->prepare("DELETE FROM `sh` WHERE excode='$m_del_code'");
    $dat10->execute();
}