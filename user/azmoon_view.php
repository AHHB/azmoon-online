<?php
session_start();
if (empty($_SESSION["user"])) {
    header("location: login/log_in.php");
}
require ("../data/db/db.php");
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


</style>
<body>
<div id="overlay" class="text-center">
    <div id="text_overlay">
        <?php
        require ("../data/class/Mobile_Detect.php");
        $detect = new Mobile_Detect;
        if ($detect->isMobile() && !$detect->isTablet() ){
            echo "لطفا موبایل خود را به صورت افقی قرار دهید";
        }
        if ($detect->isTablet()){
            echo "لطفا تبلت خود را به صورت افقی قرار دهید";
        }


        ?>
    </div>
</div>
<?php
if (isset($_GET["code"]))
    $code=$_GET["code"];
else
    header("location: azmoon_management.php");

$usern=$_SESSION["user"];
$data1=$connection->prepare("select * from users where username='$usern'");
$data1->execute();
$result1=$data1->fetchAll(PDO::FETCH_ASSOC);

$data2=$connection->prepare("select * from exam where code='$code'");
$data2->execute();
$result2=$data2->fetchAll(PDO::FETCH_ASSOC);

$data3=$connection->prepare("select * from qu where code='$code'");
$data3->execute();
$qu_count=$data3->rowCount();
$result3=$data3->fetchAll(PDO::FETCH_ASSOC);

$data4=$connection->prepare("select * from sh where excode='$code'");
$data4->execute();
$result4=$data4->fetchAll(PDO::FETCH_ASSOC);
?>
<header class="w3-grey rtl fixed-top">
    <p style="margin-bottom: 0px;padding: 0px;margin-right: 5px"class="d-inline-block"><b class="text-white"><?php echo $result1[0]["name"]." ".$result1[0]["lname"]; ?> </b> خوش آمدید.  </p>
    <a href="login/exit.php"class="text-left d-inline-block float-left "style="margin-top: 2px;margin-left: 5px;"><i class=" far fa-times-circle">خروج</i></a>
</header>
<br>
<nav class="w3-sidebar w3-bar-block w3-light-grey text-right rtl" style="width:130px"id="nav1">
    <a class="navbar-brand" href="#"style="margin: 1px;">
        <img src="../data/img/logo/آزمون%20آنلاین.png" alt="Logo" style="width:100%;">
    </a>

    <ul class="navbar-nav d-block"style="padding-right: 10px">
        <li class="nav-item ">
            <a class="nav-link " href="user.php" ><i class="fas fa-home "> خانه </i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="add.php" ><i class="fas fa-pencil-alt"> آزمون جدید </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="azmoon_management.php"><i class=" fas fa-clipboard-check text-primary"> مدیریت آزمون </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../education.php?ty=2"><i class="fas fa-bullhorn"> آموزش ها </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="setting.php"><i class="fas fa-wrench"> تنظیمات </i></a>
        </li>
    </ul>
</nav>
<div class="rtl"style="float: left;"id="body1">
    <br>
    <a href="azmoon_management.php"><i class="fas fa-arrow-alt-circle-right "> بازگشت به لیست آزمون ها</i></a>
    <button class="far fa-file-alt btn" data-toggle="modal" data-target="#q"> نمایش سوال ها </button>
    <hr>
    <?php
    if ($result2[0]["s"]==0) {
        ?>
        <div class="list-group"style="margin-left: 25px;"id="li-sh">
            <?php
            $show1=1;
            foreach ($result4 as $l1){
                echo "<a href=\"#\" class=\"list-group-item list-group-item-action sh  \"id='".$show1."'>".$l1["name"]." ".$l1["lname"] ."</a>";
                $show1++;
            }
            ?>
        </div>
        <?php
        echo "<button class='btn'id='back-sh-li'style='display: none'><i class=\"fas fa-arrow-alt-circle-right \"> بازگشت به لیست شرکت کنندگان</i></button>";

        $show2=1;
        foreach ($result4 as $l3) {
            $a1 = explode("|", $l3["a"]);
            echo "<div class='sh2' style='display: none;padding-left: 20px' id='sh".$show2."' >";
            $show2++;
            foreach ($a1 as $l2) {

                $a2 = explode("-", $l2);
                $query = $a2[0];
                $da = $connection->prepare("select * from qu where id='$query'");
                $da->execute();
                $res = $da->fetchAll(PDO::FETCH_ASSOC);
                if ($a2[1] == "1") {
                    $q = explode("-", $res[0]["a"]);
                    $c = $res[0]["c"];
                    $c = $c - 1;
                    $fl=0;
                    $q[$c] = "<i class='far fa-check-circle'style='font-size: 15px'>"."گزینه".$res[0]["c"]."- "."</i>".$q[$c];
                    for ($fl=0;$fl<4;$fl++){
                        if ($fl!=$c){
                            $fl2=$fl+1;
                            $q[$fl] = "<i class='far fa-circle'style='font-size: 15px'>"."گزینه".$fl2."- "."</i>.$q[$fl]";

                        }
                    }


                    if ($a2[2]<5){
                        $sh_c = $a2[2];
                        $sh_c = $sh_c - 1;
                        $q[$sh_c] = "<div class='alert alert-success'style='padding-right: 0px;margin-bottom: 0px;'>" . $q[$sh_c] . "</div>";
                    }

                    echo "<h2>". $res[0]["q"] . "</h2>";
                    echo "<h6>". $q[0] . "</h6>";
                    echo "<h6>". $q[1] . "</h6>";
                    echo "<h6>". $q[2] . "</h6>";
                    echo "<h6>". $q[3] . "</h6>";
                    echo "<hr>";
                }
                if ($a2[1] == 2) {
                    echo "<h2>" . $res[0]["q"] . "</h2>";
                    if ($a2[2]!=8585)
                     echo "<h6>"."جواب: " . $a2[2] . "</h6>";
                    else
                        echo "<h6>به این سوال پاسخ داده نشده است</h6>";
                }
            }
            echo "</div>";
        }
    }



    if ($result2[0]["s"]==1){
        ?>
        <a href="print.php?code=<?php echo $code; ?> "id="karnameh"><button class="btn btn-outline-info"style="margin-bottom: 20px">ایجاد کارنامه</button></a>
        <br>
        <div class="list-group"style="margin-left: 25px;"id="li-sh">
            <?php
            $show1=1;

            foreach ($result4 as $l1){
                $s_count=0;
                $aa1 = explode("|", $l1["a"]);
                for ($j=0 ;$j<$qu_count;$j++){
                    $aa2 = explode("-", $aa1[$j]);
                    $query2 = $aa2[0];
                    $da2 = $connection->prepare("select * from qu where id='$query2'");
                    $da2->execute();
                    $res2 = $da2->fetchAll(PDO::FETCH_ASSOC);
                    if ($aa2[2]==$res2[0]["c"]){
                        $s_count++;
                    }
                }

                echo "<a href=\"#\" class=\"list-group-item list-group-item-action sh  \"id='".$show1."'>".$l1["name"]." ".$l1["lname"]."(".$s_count."/".$qu_count.")"."</a>";

                $show1++;
            }
            ?>
</div>
<?php
        echo "<button class='btn'id='back-sh-li'style='display: none'><i class=\"fas fa-arrow-alt-circle-right \"> بازگشت به لیست شرکت کنندگان</i></button>";

        $show2=1;
        foreach ($result4 as $l3) {
            $a1 = explode("|", $l3["a"]);

            $s_count=0;
            for ($j=0 ;$j<$qu_count;$j++){
                $aa2 = explode("-", $a1[$j]);
                $query2 = $aa2[0];
                $da2 = $connection->prepare("select * from qu where id='$query2'");
                $da2->execute();
                $res2 = $da2->fetchAll(PDO::FETCH_ASSOC);
                if ($aa2[2]==$res2[0]["c"]){
                    $s_count++;
                }
            }

            echo "<div class='sh2' style='display: none;padding-left: 20px' id='sh".$show2."' >";
            echo "<br>"."به".$s_count." سوال از ".$qu_count." سوال پاسخ صحیح داده شده است"."<hr>";
            $show2++;
            foreach ($a1 as $l2) {

                $a2 = explode("-", $l2);
                $query = $a2[0];
                $da = $connection->prepare("select * from qu where id='$query'");
                $da->execute();
                $res = $da->fetchAll(PDO::FETCH_ASSOC);
                if ($a2[1] == "1") {
                    $q = explode("-", $res[0]["a"]);
                    $c = $res[0]["c"];
                    $c = $c - 1;
                    $fl=0;
                    $q[$c] = "<i class='far fa-check-circle'style='font-size: 15px'>"."گزینه".$res[0]["c"]."- "."</i>".$q[$c];
                    for ($fl=0;$fl<4;$fl++){
                        if ($fl!=$c){
                            $fl2=$fl+1;
                            $q[$fl] = "<i class='far fa-circle'style='font-size: 15px'>"."گزینه".$fl2."- "."</i>.$q[$fl]";

                        }
                    }


                    if ($a2[2]<5){
                        $sh_c = $a2[2];
                        $sh_c = $sh_c - 1;
                        $q[$sh_c] = "<div class='alert alert-success'style='padding-right: 0px;margin-bottom: 0px;'>" . $q[$sh_c] . "</div>";
                    }

                    echo "<h2>". $res[0]["q"] . "</h2>";
                    echo "<h6>". $q[0] . "</h6>";
                    echo "<h6>". $q[1] . "</h6>";
                    echo "<h6>". $q[2] . "</h6>";
                    echo "<h6>". $q[3] . "</h6>";
                    echo "<hr>";
                }
                if ($a2[1] == 2) {
                    echo "<h2>" . $res[0]["q"] . "</h2>";
                    if ($a2[2]!=8585)
                        echo "<h6>"."جواب: " . $a2[2] . "</h6>";
                    else
                        echo "<h6>به این سوال پاسخ داده نشده است</h6>";
                }
            }
            echo "</div>";
        }
    }
    ?>

    <br><br><br>
    <div class="text-light">.</div>
</div>

<footer class="fixed-bottom d-inline-block text-center bg-light"style="font-size: 10px;margin: 2px;padding: 2px;">
    <img src="../data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 16px">
    <p class="text-secondary d-inline-block"style="margin-bottom: 0px"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"style="margin-bottom: 0px"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>
<script>
    $(document).ready(function () {
        function size() {
            var w=$(window).width();
            var h=$(window).height();
            $('#body1').width(w-150);

            <?php
            if ($detect->isMobile() or $detect->isTablet()){
            ?>
            if (w<h) {
                function on() {
                    document.getElementById("overlay").style.display = "block";
                }
                on();
                $('body').addClass('blur');
            }else {
                function off() {
                    document.getElementById("overlay").style.display = "none";
                }
                off();
                $('body').removeClass('blur')
            }
            <?php
            }
            ?>
        }
        size();
        setInterval(size,500);

        $('.sh').click(function () {
            var iid=$(this).attr("id");
            $('#li-sh').hide(50);
            $('#karnameh').hide(50);
            $('#back-sh-li').show(50);
            $('#sh'+iid).show(50);
        });

        $('#back-sh-li').click(function () {
            $('#li-sh').show(50);
            $('#karnameh').show(50);
            $('#back-sh-li').hide(50);
            $('.sh2').hide(50);
        });

    });

</script>

<!-- سوال -->
<div class="modal fade rtl" id="q">
    <div class="modal-dialog rtl">
        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">سوالات </h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">

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
                ?>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal"style="margin-left: 10px;"id="add-close">بستن</button>
            </div>
        </div>
    </div>
</div>
