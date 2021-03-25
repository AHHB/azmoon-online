<?php
session_start();
if (empty($_SESSION["admin"])) {
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
<body>
<div id="overlay">
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
$usern=$_SESSION["admin"];
$data1=$connection->prepare("select * from admin where username='$usern'");
$data1->execute();
$result1=$data1->fetchAll(PDO::FETCH_ASSOC);


?>
<header class="w3-dark-grey rtl fixed-top">
    <p style="margin-bottom: 0px;padding: 0px;margin-right: 5px"class="d-inline-block">  شما در  قالب  <b class="text-primary"><?php echo $result1[0]["name"]." ".$result1[0]["lname"]; ?> </b> وارد شده اید. </p>
    <a href="login/exit.php"class="text-left d-inline-block float-left "style="margin-top: 2px;margin-left: 5px;"><i class=" far fa-times-circle">خروج</i></a>
</header>
<br>
<nav class="w3-sidebar w3-bar-block w3-light-grey text-right rtl" style="width:130px"id="nav1">
    <a class="navbar-brand" href="#"style="margin: 1px;">
        <img src="../data/img/logo/آزمون%20آنلاین.png" alt="Logo" style="width:100%;">
    </a>

    <ul class="navbar-nav d-block"style="padding-right: 10px">
        <li class="nav-item ">
            <a class="nav-link " href="admin.php" ><i class="fas fa-home text-primary"> خانه </i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="users.php" ><i class="fas fa-user"> اعضا </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="massage.php"><i class=" fas fa-envelope"> پیام ها </i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="setting.php"><i class="fas fa-wrench"> تنظیمات </i></a>
        </li>
    </ul>
</nav>
<div class="rtl"style="float: left;"id="body1">

    <div style="margin-top: 25px;">
        <div class="row">
        <div class="col-1"></div>
        <div class="col-4 w3-light-gray text-center" style="border-radius: 5px;padding: 5px;">
            <h3>مدیران: </h3>
            <?php
            $count_admin=$data1->rowCount();
            echo $count_admin." نفر";
            ?>
        </div>
        <div class="col-2"></div>
        <div class="col-4 w3-light-gray text-center"style="border-radius: 5px;padding: 5px;">
            <h3>کاربران: </h3>
            <?php
            $data2=$connection->prepare("select * from users");
            $data2->execute();
            $count_user=$data2->rowCount();
            echo $count_user." نفر";
            ?>
        </div>
        <div class="col-1"></div>
        </div>

        <br>

        <div class="row">
        <div class="col-1"></div>
        <div class="col-4 w3-light-gray text-center"style="border-radius: 5px;padding: 5px;">
            <h3>آزمون ها:</h3>
            <?php
            $data3=$connection->prepare("select * from exam");
            $data3->execute();
            $count_exam=$data3->rowCount();
            echo $count_exam." آزمون";
            ?>
        </div>
        <div class="col-2"></div>
        <div class="col-4 w3-light-gray text-center"style="border-radius: 5px;padding: 5px;">
            <h3>شرکت کنندگان: </h3>
            <?php
            $data4=$connection->prepare("select * from sh");
            $data4->execute();
            $count_sh=$data4->rowCount();
            echo $count_sh." نفر";
            ?>
        </div>
        <div class="col-1"></div>
        </div>


    </div>
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
            var w=$(document).width();
            var h=$(document).height();
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
        setInterval(size,1000);





    });

</script>