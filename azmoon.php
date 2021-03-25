<?php
require ("data/db/db.php");
session_start();

if ($_SESSION["sh2"]=="er"){
    header("location: error.php?e=4");
}

?>
<!doctype html>
<html lang="fa"dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="data/style/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="data/style/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="data/style/js/jquery%203.4.1.js"></script>
    <script src="data/style/js/main_js.js"></script>
    <link rel="stylesheet" href="data/style/css/w3.css">
    <link rel="stylesheet" href="data/style/font/font.css">
    <link rel="stylesheet" href="data/style/css/main_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>
</head>
<body>
<?php
if ($_SESSION["sh"]=="")
    header("location: index.php");
$code=$_SESSION["sh"];
$data=$connection->prepare("select * from sh where code='$code'");
$data->execute();
$result=$data->fetchAll(PDO::FETCH_ASSOC);

$excode=$result[0]["excode"];
$data2=$connection->prepare("select * from exam where code='$excode'");
$data2->execute();
$result2=$data2->fetchAll(PDO::FETCH_ASSOC);

$data3=$connection->prepare("select * from qu where code='$excode'");
$data3->execute();
$result3=$data3->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION["sh2"])){
    $sh2_code=$_SESSION["sh2"];
    $data4=$connection->prepare("select * from sh where excode='$excode' and lname='$sh2_code'");
    $data4->execute();
    $result4=$data4->rowCount();
    if ($result4!=1)
        header("location: error.php?e=5");
}

if ($result2[0]["end"]==0)
    header("location: index.php");

$af2="";

?>
<header class="header-two"style="height: 100px;">
    <img src="data/img/logo/آزمون%20آنلاین.png" alt="logo"class="img-fluid "style="height: 95px;">
</header>
<nav class="navbar navbar-expand-sm bg-light sticky-top">
    <ul class="navbar-nav">
        <li class="nav-item"style="margin-left: 30px;">
           <h5 class="text-primary "> <?php echo "<i class='fas fa-user-alt'></i>"." ".$result[0]["name"]." ".$result[0]["lname"]; ?></h5>
        </li>

        <li class="nav-item"style="margin-left: 30px;">
            <h4 id="timer"class=""></h4>
        </li>
    </ul>
</nav>

    <div class="fixed-bottom bg-light" id="asave" style="display: none ;margin-bottom: 2px;margin-right: 90%;padding: 5px;border-radius: 5px;width: 40px;">
        <div class="spinner-border text-success"></div>
    </div>

<?php

?>
<div class="container rtl">

    <?php
    date_default_timezone_set("Asia/Tehran");
    $tody=time();
    $t=explode("-",$result2[0]["time"]);
    $d=explode("-",$result2[0]["date"]);
    $d1=explode("-",$result2[0]["date"]);

    if ($d[0]==$d[1]){
        
        $tt=date("H",(int)$d[0]);
        $ti=date("i",(int)$d[0]);
        $tt2=(int)$d[0];
        $tt2=$tt2-$tt*3600;
        $d[0]=$tt2+$t[0]*3600-$ti*60;
        $d[1]=$tt2+$t[1]*3600-$ti*60;
    }

    if ($tody>$d[0] && $tody<$d[1]){ 
        
        if ($d1[0]==$d1[1]){
            if ($t[0] <= date("H") && $t[1] >= date("H")){

            }else{
                header("location: error.php?e=2");
            }
        }else{
            $d0=(int)$d1[0];
            $d1=(int)$d1[1];
            $d00=$d0+86400;
            $d11=$d1-86400;
            $eghtelaf=$d1- $d0;
            if ($eghtelaf==86400){

            }else{
                if ($tody>=$d1[0] && $tody<=$d00){
                    if ($t[0]>date("H")){
                        header("location: error.php?e=2");
                    }
                }
                if ($tody>=$d11 && $tody<=$d1[1]){
                    if ($t[1]<date("H")){
                        header("location: error.php?e=2");
                    }
                }
            }
        }

    }else{
        header("location: error.php?e=2");
    }

    if ($result2[0]["num"]!=0){
        $sh_count=0;
        foreach ($result as $ll1){
            if ($excode==$ll1["excode"])
                $sh_count++;
        }
        if ($sh_count!=0)
            header("location: error.php?e=3");
    }
    ?>

    <?php
    $time=explode("-",$result2[0]["t"]);
    if ($time[0]==1){
        echo "<input type='hidden'id='t'value='".$time[1]."'>";
        foreach ($result3 as $res3){
            $type1=$res3["type"];
            if ($type1==1){
                $a1=explode("-",$res3["a"]);
                ?>
                <h3 class="bg-light"style="padding: 7px;margin-bottom: 0px;border-top-left-radius: 5px;border-top-right-radius:5px; "><?php echo $res3["q"]; ?> </h3>
                <div class="w3-light-gray"style="padding: 5px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                <div class="form-check">
                    <label class="form-check-label" style="width: 100%;background-color: #f4f5f9;padding: 5px;border-radius: 5px;margin-right:8px;margin-bottom: 3px;">
                        <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."1"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[0]; ?></p>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" style="width: 100%;background-color: #F4F5F9;padding: 5px;border-radius: 5px;margin-right:8px;margin-bottom: 3px;">
                        <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."2"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[1]; ?></p>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" style="width: 100%;background-color: #F4F5F9;padding: 5px;border-radius: 5px;margin-right:8px;margin-bottom: 3px;">
                        <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."3"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[2]; ?></p>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label"style="width: 100%;background-color: #F4F5F9;padding: 5px;border-radius: 5px;margin-right:8px;">
                        <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."4"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo $a1[3]; ?></p>
                    </label>
                </div>
                </div>
                <hr>
                <?php
                $af=$res3["id"]."-".$res3["type"]."-"."85"."|";
                $af2=$af2.$af;
            }
            if ($type1==2){
                $af=$res3["id"]."-".$res3["type"]."-"."8585"."|";
                $af2=$af2.$af;
                ?>
                <h3 class="bg-light"style="padding: 7px;margin-bottom: 0px;border-top-left-radius: 5px;border-top-right-radius:5px; "><?php echo $res3["q"]; ?> </h3>
                <div class="w3-light-gray"style="padding: 10px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                    <input type="text"class="form-control a2"id="<?php echo $res3["id"]."-".$res3["type"]."-"; ?>"placeholder="جواب خود را وارد کنید">
                </div>
                <?php

            }
        }
    }
    if ($time[0]==2) {
        echo "<input type='hidden'id='t'value='" . $time[1] . "'>";
        $id_count=1;
        foreach ($result3 as $res3){
            $type1=$res3["type"];
            if ($type1==1){
                $a1=explode("-",$res3["a"]);
                ?>
                <div class=""id="t2-<?php echo $id_count;?>"style="display: none;">
                <h3 class="bg-light"style="padding: 7px;margin-bottom: 0px;border-top-left-radius: 5px;border-top-right-radius:5px; "><?php echo $res3["q"]; ?> </h3>
                <div class="w3-light-gray"style="padding: 5px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."1"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[0]; ?></p>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."2"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[1]; ?></p>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."3"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo "  ".$a1[2]; ?></p>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input a1" name="optradiooptradio-<?php echo $res3["id"];?>"id="<?php echo $res3["id"]."-".$res3["type"]."-"."4"; ?>"><p style="margin-right: 20px;margin-bottom: 0px;"><?php echo $a1[3]; ?></p>
                        </label>
                    </div>
                </div>
                </div>

                <?php
                $af=$res3["id"]."-".$res3["type"]."-"."85"."|";
                $af2=$af2.$af;
            }
            if ($type1==2){
                $af=$res3["id"]."-".$res3["type"]."-"."8585"."|";
                $af2=$af2.$af;
                ?>
             <div class=""id="t2-<?php echo $id_count;?>"style="display: none;">
                <h3 class="bg-light"style="padding: 7px;margin-bottom: 0px;border-top-left-radius: 5px;border-top-right-radius:5px; "><?php echo $res3["q"]; ?> </h3>
                <div class="w3-light-gray"style="padding: 10px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                    <input type="text"class="form-control a2"id="<?php echo $res3["id"]."-".$res3["type"]."-"; ?>"placeholder="جواب خود را وارد کنید">
                </div>
             </div>
                <?php

            }
            $id_count++;
        }
        ?>
        <br>
        <button class="btn btn-outline-info"id="next">سوال بعدی</button>
        <?php

    }
    $afdata=$connection->prepare("UPDATE `sh` SET `a`='$af2' WHERE code='$code'");
    $afdata->execute();
    ?>
    <hr style="border: 1px black solid">
    <a href="end.php"><button class="btn btn-primary btn-lg"id="end">پایان آزمون</button> </a>

    <br><br><br>
    <p class="text-secondary">.</p>
</div>

<footer class="fixed-bottom d-inline-block text-center"style="width: 100%;">
    <hr class="text-secondary">
    <img src="data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px">
    <p class="text-secondary d-inline-block"><?php built(); ?></p><p class="d-inline text-secondary"></p>
</footer>
</body>
</html>

<script>
    $(document).ready(function () {
        <?php
            if ($time[0]==1){
        ?>
        var t = $('#t').val();
        var minute = t;
        var sec = 0;

        setInterval(function(){

            if(sec >0){
                sec = sec-1;

            }
            if(sec == 0 && minute >0){
                minute = minute - 1;
                sec= 59;
            }

            if (sec == 0 && minute == 0){
                $('#end').trigger("click");
            }
            $('#timer').html( "<i class='far fa-clock'></i>"+" "+minute +":"+ sec );

        },1000);
        <?php
        }
        ?>





        <?php
        if ($time[0]==2){
        ?>
        $('#t2-1').show();

        var t = $('#t').val();

        var minute = 0;
        var sec = t;
        var rti=0;
        setInterval(function(){
            if(sec >0){
                sec = sec-1;
            }
            if(sec == 0 && minute >0){
                minute = minute - 1;
                sec= 59;
            }
            if (sec == 0 && minute == 0){
                //if (rti==0) {
                    $('#next').trigger("click");
                    rti=1;
                //}
            }

                $('#timer').html("<i class='far fa-clock'></i>" + " " + sec + " ثانیه");

        },1000);

       // var rti2=0;
        var i=1;
        $('#next').click(function () {
            sec=t;
            rti=0;
            $('#t2-'+i).hide(100);
            i++;
            $('#t2-'+i).show(100);

            if (!$('#t2-'+i).children().is("h3")){
                $('#end').trigger("click");
            }

         });

        <?php
        }
        ?>



        $('.a1').click(function () {
            var iidd=$(this).attr("id");
            $.ajax({
               type:"POST",
               url:'user/op/user_control.php',
               data:"a1=1&id="+iidd,
               success:function () {
                   $('#asave').show(200);
                   $('#asave').delay(600).hide(200);
               }
            });
        });

        $('.a2').focusout(function () {
            var iiddd=$(this).attr("id")+$('#'+$(this).attr("id")).val();
            $.ajax({
                type:"POST",
                url:'user/op/user_control.php',
                data:"a1=1&id="+iiddd,
                success:function () {
                    $('#asave').show(200);
                    $('#asave').delay(600).hide(200);
                }
            });
        });


    });
</script>
