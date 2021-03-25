<?php
require ("data/db/db.php");
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
<nav class="navbar navbar-expand-sm bg-secondary ">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="user/login/log_in.php"><i class="fas fa-door-open"> ورود </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin/login/signup.php"><i class="fas fa-sign-in-alt"> عضویت </i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-bullhorn"> آموزش ها </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="call.php"><i class="fas fa-question-circle"> تماس با ما </i></a>
        </li>
    </ul>
</nav>
<?php

?>
<div class="container rtl">

    <h2>فیلم آموزش شرکت در آزمون: </h2>
    <hr>
    <div class="card shadow text-center m-4 offset-3">
        <video controls="controls" style="width: 100%">
            <source src="data/movie/شرکت%20کنندگان%20در%20آزمون.mp4" type="video/mp4" />
        </video>
    </div>

    <h2>سوالات متداول: </h2>
    <hr>
    <div id="accordion"class="shadow">

        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    <h3>زمان شرکت در آزمون تمام نشده ولی پیام زمان آزمون پایان یافته است به من نشان داده میشود.</h3>
                </a>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    بعضی وقت ها ممکن است این مشکل رخ دهد. برای حل این مشکل فقط کافیست تا مرورگر خود را ببندید و دوباره وارد لینک آزمون شوید.
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                    <h3>هنگام امتحان اینترنت من قطع شد</h3>
                </a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    در این مواقع تا وصل شدن دوباره اینترنت نباید از صفحه امتحان خارج شوید. توجه داشته باشید که به محض پاسخ به هر سوال گزینه انتخابی شما در سیستم ثبت میشود.
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                    <h3>به همه سوال ها پاسخ درست داده ام ولی پاسخ من ثبت نشده یا پاسخ اشتباه به جای آن ثبت شده است</h3>
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    اگر اینترنت شما دارای سرعت کافی نباشد، هنگامی که به سوالی پاسخ می دهید در گوشه چپ صفحه نوار چرخانی به شما نشان داده میشود که بیان گر ارسال پاسخ شما به سرور است.برای جلوگیری از این دست مشکلات تا پایان نمایش آن صبر کنید سپس به سوال بعدی پاسخ دهید
                </div>
            </div>
        </div>

        </div>

    </div>

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
