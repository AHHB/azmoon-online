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
<nav class="navbar navbar-expand-sm bg-secondary sticky-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="user/login/log_in.php"><i class="fas fa-door-open"> ورود </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin/login/signup.php"><i class="fas fa-sign-in-alt"> عضویت </i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="education.php?ty=1"><i class="fas fa-bullhorn"> آموزش ها </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-bottom-0" href="call.php"><i class="fas fa-question-circle"> تماس با ما </i></a>
        </li>
    </ul>
</nav>
<?php

?>
<div class="container rtl">
    <br>
    <p style="font-size: 20px;">لطفا ما را در جریان نظرات،انتفادات و پیشنهادات خود قرار دهید.</p>
    <p style="font-size: 20px;">در صورت مشاهده مشکل سریعا ما را در جریان قرار دهید.</p>
    <p style="font-size: 18px;">طراح سایت: امیر حسین حسنی <img src="data/img/logo/ahhm-black.png" alt="logo"class="img-fluid"style="height: 25px;"></p>
    <p>ایمیل: amirhosseinhassani@outlook.com</p>

    <input type="text"id="call-name"class="form-control col-8"placeholder="نام و نام خانوادگی..."><br>
    <input type="email"id="call-email"class="form-control col-8"placeholder="ایمیل(اختیاری)"><br>
    <textarea class="form-control col-8"placeholder="..."id="call-text"></textarea><br>
    <button class="btn btn-success"id="submit">ارسال</button>
    <br><br>
    <div class="alert alert-success"id="alert-s"style="display: none">
        پیام شما با موفقیت ارسال شد
    </div>
    <div class="alert alert-danger"id="alert-d"style="display: none">
        تمامی موارد باید تکمیل شود
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

        $('#submit').click(function () {
            var name=$('#call-name').val();
            var email=$('#call-email').val();
            var text=$('#call-text').val();

            if (name!="" && text!=""){
                $.ajax({
                    type: "POST",
                    url: 'admin/op/control.php',
                    data: "call=1&name="+name+"&email="+email+"&text="+text,
                    success:function () {
                        $('#alert-s').show(500);
                        $('#alert-s').delay(2000).hide(500);
                    }
                });
            } else {
                $('#alert-d').show(500);
                $('#alert-d').delay(2000).hide(500);
            }
        });

    });
</script>
