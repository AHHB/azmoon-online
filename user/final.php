<?php
require ("../data/db/db.php");
require ("../data/class/jdf.php");
session_start();
?>
<!doctype html>
<html lang="fa"dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../data/style/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../data/style/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../data/style/js/jquery%203.4.1.js"></script>
    <script src="../data/style/js/main_js.js"></script>
    <link rel="stylesheet" href="../data/style/css/w3.css">
    <link rel="stylesheet" href="../data/style/font/font.css">
    <link rel="stylesheet" href="../data/style/css/main_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>
</head>
<style>
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>
<body>

<?php
date_default_timezone_set("Asia/Tehran");
$code=$_SESSION["exam"];
$data=$connection->prepare("select * from exam where code='$code'");
$data->execute();
$result=$data->fetchAll(PDO::FETCH_ASSOC);
$data2=$connection->prepare("select * from qu where code='$code' and type='2'");
$data2->execute();
$type2=$data2->rowCount();
$data3=$connection->prepare("select * from qu where code='$code'");
$data3->execute();
$qcount=$data3->rowCount();
$result3=$data3->fetchAll(PDO::FETCH_ASSOC);
$flag_date=0;
$flag_time=0;
$flag_t=0;
$flag_s=0;
$today=time();
$today=$today-3600;

$q_time=explode("-",$result[0]["t"]);

$data=explode("-",$result[0]["date"]);
if ($today<=$data[0]){
    $flag_date=0;
    if ($data[0]<=$data[1]){
        $flag_date=0;
    }else{
        $flag_date=1;
    }
}else{
    $flag_date=1;

}

$time=explode("-",$result[0]["time"]);

    if ($data[0]==$data[1]){
        if ($time[0]<$time[1]){
            $flag_time=0;
        }else{
            $flag_time=1;

        }

            

    }



if ($result[0]["t"]!=0){
    $flag_t=0;
}else{
    $flag_t=1;
}

if ($result[0]["s"]==1){
    if ($type2>0){
        $flag_s=1;
    }else{
        $flag_s=0;
    }
}
?>

<div class="jumbotron rtl">
    <?php
    if ($flag_date==1){
        echo "<h2><i class='fas fa-exclamation-triangle text-danger'></i> مشکلی در تاریخ برگزاری آزمون وجود دارد</h2>";
    }
    if ($flag_time==1){
        echo "<h2><i class='fas fa-exclamation-triangle text-danger'></i> مشکلی در ساعت برگزاری آزمون وجود دارد</h2>";
    }
    if ($flag_t==1){
        echo "<h2><i class='fas fa-exclamation-triangle text-danger'></i> مدت زمان آزمون ثبت نشده است</h2>";
    }
    if ($flag_s==1){
        echo "<h2><i class='fas fa-exclamation-triangle text-danger'></i> هنگامی که تصحیح خودکار فعال است نمی توان از سوال تشریحی استفاده کرد</h2>";
    }

    if ($flag_date==1 or $flag_time==1 or $flag_t==1 or $flag_s==1){
        echo "<a href='add.php'><button class='btn btn-dark'>بازگشت</button></a>";
    }

    if ($flag_date==0 && $flag_time==0 && $flag_t==0 && $flag_s==0){
        $data4=$connection->prepare("UPDATE `exam` SET `end`='1' WHERE code='$code'");
        $data4->execute() or die("مشکلی در ارسال داده ها پیش آمده است. ");

        echo "<h2><i class=' far fa-check-square text-success'></i> تایید نهایی آزمون با موفقیت انجام شد.</h2>";
        ?>
        <hr style="border: 2px black dotted">
        <h3><?php echo "نام آزمون: ".$result[0]["name"]; ?>  </h3>
        <h4><?php echo "<i class=\"far fa-calendar-check\"></i>"." شروع آزمون: ".jdate("o/m/d",$data[0])." ساعت: ".$time[0].":00"; ?>  </h4>
        <h4><?php echo "<i class=\"far fa-calendar-times\"></i>"." پایان آزمون: ".jdate("o/m/d",$data[1])." ساعت: ".$time[1].":00"; ?>  </h4>
        <h4><?php echo "<i class=\"far fa-file-alt\"></i>"." تعداد سوالات: ".$qcount; ?> </h4>
        <h4><?php if ($q_time[0]==1) echo "<i class=\"far fa-clock\"></i>"." زمان آزمون: ".$q_time[1]." دقیقه برای کل آزمون"; else echo "<i class=\"far fa-clock\"></i>"." زمان آزمون: ".$q_time[1]." ثانیه برای هر سوال"; ?> </h4>
        <h4><?php if ($result[0]["num"]==0) echo "<i class=\"far fa-user\"></i>"." محدودیت در تعداد شرکت کنندگان: محدودیتی وجود ندارد "; else echo "<i class=\"far fa-user\"></i>"." محدودیت در تعداد شرکت کنندگان: ".$result[0]["num"]." نفر"; ?> </h4>
        <h4><?php if ($result[0]["s"]==0) echo "<i class=\"fas fa-magic\"></i>"." تصحیح خودکار: غیرفعال"; else echo "<i class=\"fas fa-magic\"></i>"." تصحیح خودکار: فعال"; ?></h4>
        <br><br>
        <div>
            <label><i class="fas fa-share-alt"></i> لینک آزمون: </label><br>
            <input type="text"id="shre"value="<?php echo "http://azmoon-online.gigfa.com/"."index.php?ex=".$_SESSION["exam"]; ?> "style="width: 300px;border: none;height: 34px;border-radius: 5px;text-align: left;background-color: rgb(204,205,208);margin-left: 0px;color: #1a6be6;text">
            <button class="btn btn-info"id="btn-shre"><i class="far fa-clone"></i></button>
        </div><br>

        <form action="op/final_control.php"method="post">
            <input type="submit"name="b_submit"value="بازگشت"class="btn btn-dark d-inline-block">
            <input type="submit"name="t_submit"value="تایید"class="btn btn-light d-inline-block">
        </form>

        <script>
            $(document).ready(function () {
                $('#btn-shre').click(function () {
                    $('#shre').select();
                    document.execCommand("copy");
                });
            });


        </script>


        <hr style="border: 1px rgba(29,33,36,0.89) dotted">

        <h5>سوالات: </h5>
        <?php
        $i=1;
        foreach ($result3 as $q){
            if ($q["type"]==2){
                echo "<i class=\"far fa-file-alt\"></i>"." سوال".$i." _ ".$q["q"];
                echo "<br>";
            }
            if ($q["type"]==1){
                echo "<i class=\"far fa-file-alt\"></i>"."سوال".$i." _ ".$q["q"]."<br>";
                $a=explode("-",$q["a"]);
                $c=$q["c"];
                $c=$c-1;
                $a[$c]="<i class=\"fas fa-check\">".$a[$c]."</i>";
                echo "  1-".$a[0]."<br>";
                echo "  2-".$a[1]."<br>";
                echo "  3-".$a[2]."<br>";
                echo "  4-".$a[3]."<br>";
                echo "<br>";
            }
            $i++;
            echo "<br>";
        }
    }else{
        $data5=$connection->prepare("UPDATE `exam` SET `end`='0' WHERE code='$code'");
        $data5->execute() or die("مشکلی در ارسال داده ها پیش آمده است. ");
    }
    ?>

</div>

<footer class="fixed-bottom d-inline-block text-center">
    <hr class="text-secondary">
    <img src="../data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px">
    <p class="text-secondary d-inline-block"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>
