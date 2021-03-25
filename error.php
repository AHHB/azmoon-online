<?php
require ("data/db/db.php");
session_start();
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
<header class="header-two">
    <img src="data/img/logo/آزمون%20آنلاین.png" alt="logo"class="img-fluid header-logo">
</header>
<nav class="navbar navbar-expand-sm bg-secondary sticky-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="user/login/log_in.php"><i class="fas fa-door-open"> ورود </i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="education.php?ty=1"><i class="fas fa-bullhorn"> آموزش ها </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="call.php"><i class="fas fa-question-circle"> تماس با ما </i></a>
        </li>
    </ul>
</nav>
<?php

?>
<div class="container rtl">

    <?php
    if (isset($_GET["e"])){
        $e=$_GET["e"];

        if ($e==1){
            ?>
            <br>
            <div class="alert alert-warning">
                <h1 class="text-danger"><i class=" fas fa-exclamation-triangle">هیچ آزمونی یافت نشد</i></h1>
            </div>
            <?php
        }

        if ($e==2){
            $code=$_SESSION["sh"];
            $data=$connection->prepare("DELETE FROM `sh` WHERE code='$code'");
            $data->execute();
            $_SESSION["sh"]=null;
            ?>
            <br>
            <div class="alert alert-warning">
                <h1 class="text-danger"><i class=" fas fa-exclamation-triangle">مهلت برگزاری آزمون پایان یافته است</i></h1>
            </div>
            <?php
        }

        if ($e==3){
            $code=$_SESSION["sh"];
            $data=$connection->prepare("DELETE FROM `sh` WHERE code='$code'");
            $data->execute();
            $_SESSION["sh"]=null;
            ?>
            <br>
            <div class="alert alert-warning">
                <h1 class="text-danger"><i class=" fas fa-exclamation-triangle">ظرفیت آزمون تکمیل شده است</i></h1>
            </div>
            <?php
        }


        if ($e==4){
            $code=$_SESSION["sh"];
            $data=$connection->prepare("DELETE FROM `sh` WHERE code='$code'");
            $data->execute();
            $_SESSION["sh2"]=null;
            $_SESSION["sh"]=null;
            ?>
            <br>
            <div class="alert alert-warning">
                <h1 class="text-danger"><i class=" fas fa-exclamation-triangle">کد وارد شده معتبر نمی باشد</i></h1>
            </div>
            <?php
        }

        if ($e==5){
            $code=$_SESSION["sh"];
            $data=$connection->prepare("DELETE FROM `sh` WHERE code='$code'");
            $data->execute();
            $_SESSION["sh2"]=null;
            $_SESSION["sh"]=null;
            ?>
            <br>
            <div class="alert alert-warning">
                <h1 class="text-danger"><i class=" fas fa-exclamation-triangle">شما قبلا در آزمون شرکت کرده اید</i></h1>
            </div>
            <?php
        }



    }else{
        header("location: index.php");
    }
    ?>




    <br><br><br>
    <p class="text-secondary">.</p>
</div>

<footer class="fixed-bottom d-inline-block text-center">
    <hr class="text-secondary">
    <img src="data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px">
    <p class="text-secondary d-inline-block"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>

<script>
    $(document).ready(function () {


    });
</script>
