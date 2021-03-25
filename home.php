<?php
require ("data/db/db.php");
session_start();
$_SESSION["sh"]=null;
$_SESSION["sh2"]=null;

$dat1=$connection->prepare("select * from exam");
$dat1->execute();
$res1=$dat1->rowCount();
$dat2=$connection->prepare("select * from sh");
$dat2->execute();
$res2=$dat2->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="آزمون ساز رایگان">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="آزمون آنلاین" /> <!-- website name -->
    <meta property="og:site" content="azmoon-online.gigfa.com" /> <!-- website link -->

    <!-- Website Title -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="data/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="data/style/css/swiper.css" rel="stylesheet">
    <link href="data/style/css/magnific-popup.css" rel="stylesheet">
    <link href="data/style/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="data/style/css/w3.css">
    <link rel="stylesheet" href="data/style/font/font.css">
    <link rel="stylesheet" href="data/style/css/main_style.css">


    <!-- Favicon  -->
</head>
<body data-spy="scroll" data-target=".fixed-top">

<!-- Preloader -->
<div class="spinner-wrapper">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- end of preloader -->


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top rtl">
    <!-- Text Logo - Use this if you don't have a graphic logo -->
     <a class="navbar-brand logo-text page-scroll rtl text-dark" href="index.php">آزمون آنلاین</a>


    <!-- Mobile Menu Toggle Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
    </button>
    <!-- end of mobile menu toggle button -->

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link page-scroll " href="user/login/log_in.php"><i class="fas fa-door-open"> ورود آزمون گیرنده </i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="admin/login/signup.php"><i class="fas fa-sign-in-alt"> عضویت آزمون گیرنده </i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="education.php?ty=1"><i class="fas fa-bullhorn"> آموزش ها </i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="call.php"><i class="fas fa-question-circle"> تماس با ما </i></a>
            </li>
        </ul>
        <span class="nav-item social-icons">
                <span class="fa-stack">
                    <a href="mailto: amirhosseinhassani@outlook.com">
                        <i class=" 	fas fa-envelope-square "></i>
                    </a>
                </span>
            <span class="fa-stack">
                    <a href="https://telegram.me/A_H_H_B_79">
                        <i class="fas fa-paper-plane "></i>
                    </a>
                </span>
            </span>
    </div>
</nav> <!-- end of navbar -->
<!-- end of navigation -->


<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 rtl">
                    <div class="text-container">
                        <?php
                        if (!isset($_GET["ex"])) {
                        ?>
                        <h1 class="rtl">با <span class="turquoise">آزمون آنلاین </span> شروع به ساخت آزمون کنید </h1>
                        <p class="p-large">آزمون آنلاین یک آزمون ساز آنلاین است و با استفاده از آن می توانید به راحتی آزمون ها، امتحان ها، تست ها و مسابقات را به صورت رایگان به‌صورت یک آزمون آنلاین یا کنکور آنلاین برگزار کنید. با ثبت‌ نام در سامانه اولین آزمون خود را بسازید.</p>
                        <?php
                        }else{
                            ?>
                            <h5>لطفا قبل از شروع آزمون به قسمت آموزش مراجعه کنید تا با طریقه کارکرد سیستم آشنا شوید تا با مشکل مواجه نشوید.</h5>
                            <a href="education.php?ty=1" class="text-primary">برای ورود به قسمت آموزش اینجا کلیک کنید</a>
                            <br><br>
                            <?php
                        }
                        if (!isset($_GET["ex"])) {
                        ?>
                        <a class="btn-solid-lg page-scroll" href="#services">بیشتر با ما آشنا شوید</a>
                        <?php
                        }else{
                            ?>
                            <a class="btn-solid-lg page-scroll" href="#start">شروع آزمون</a>
                        <?php
                        }
                        ?>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="data/img/logo/آزمون%20آنلاین.png" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<!-- end of header -->

<?php
if (isset($_GET["ex"])) {
    $code = $_GET["ex"];

    $err=$connection->prepare("select * from exam");
    $err->execute();
    $res=$err->fetchAll(PDO::FETCH_ASSOC);
    $flag_err=0;
    foreach ($res as $re){
        if ($code==$re["code"])
            $flag_err=1;
    }
    if ($flag_err==0)
        header("location: error.php?e=1");

    $data = $connection->prepare("select * from exam where code='$code'");
    $data->execute();
    $result=$data->fetchAll(PDO::FETCH_ASSOC);
    $usn=$result[0]["username"];
    $data2=$connection->prepare("select * from users where username='$usn'");
    $data2->execute()or die("هیچ آزمونی یافت نشد");;
    $result2=$data2->fetchAll(PDO::FETCH_ASSOC);
    $data3=$connection->prepare("select * from qu where code='$code'");
    $data3->execute()or die("هیچ آزمونی یافت نشد");;
    $qucount=$data3->rowCount();

    $t=explode("-",$result[0]["t"]);
    ?>
        <div class="container rtl">
            <br><br>
            <div class="w3-card-4" id="start">
                <div class="w3-container w3-light-grey">
                    <h3><?php echo $result[0]["name"]; ?> </h3>
                </div>
                <input type="hidden"id="excode"value="<?php echo $code; ?>">
                <div class="w3-container">
                    <p class="sh-a"><?php echo "نام و نام خانوادگی برگزار کننده: ".$result2[0]["name"]." ".$result2[0]["lname"]; ?> </p>
                    <p class="sh-a"><?php echo "تعداد سوالات: ".$qucount; ?> </p>
                    <p class="sh-a"><?php if ($t[0]==1) echo "زمان آزمون: ".$t[1]." دقیقه برای کل آزمون"; else echo "زمان آزمون: ".$t[1]." ثانیه برای هر سوال"; ?> </p>
                </div>
                <button class="w3-button w3-block w3-dark-grey"  data-toggle="modal" data-target="#<?php if ($result[0]["num"]=="a") echo "add2"; else echo "add1"; ?> ">شروع آزمون</button>
            </div>
            <br><br>
        </div>
    <?php
}else{
?>


<!-- Services -->
<div id="services" class="cards-1 rtl">
    <div class="container">
        <br>
        <div class="row text text-center">
            <div class="col-lg-12">

                <!-- Card 1 -->
                <div class="card text-center">
                    <img class="card-image" src="data/img/logo/step-create.png" alt="step-create">
                    <div class="card-body">
                        <h4 class="card-title">طراحی آنلاین سؤالات آزمون</h4>
                        <p>شما بعد از ثبت‌نام در سامانه و با ورود به بخش آزمون ساز می‌توانید آزمون خود را تعریف نمایید. بعد با ورود به قسمت طراحی سوالات می‌توانید سوالات را طراحی کرده و جواب‌های درست را تعیین کنید. برای شروع می‌توانید از بسته رایگان استفاده کنید و آزمون آنلاین رایگان بسازید.</p>
                    </div>
                </div>
                <!-- end of card 1 -->

                <!-- Card 2 -->
                <div class="card">
                    <img class="card-image" src="data/img/logo/step-answers.png" alt="step-answers">
                    <div class="card-body">
                        <h4 class="card-title">شرکت در آزمون به‌صورت آنلاین</h4>
                        <p>بعد از طراحی آزمون و سوالات آن از سامانه یک لینک پاسخ‌گویی دریافت می‌کنید که می‌توانید آن را برای شرکت‌کنندگان در آزمون ارسال کنید. شرکت کنندگان از طریق لینکی که در اختیارشان قرار گرفته به صفحه آزمون وارد می‌شوند و به آن پاسخ می دهند. </p>
                    </div>
                </div>
                <!-- end of card 2 -->

                <!-- Card 3 -->
                <div class="card">
                    <img class="card-image" src="data/img/logo/ic-correction.png" alt="step-answers">
                    <div class="card-body">
                        <h4 class="card-title">تصحیح آنلاین و خودکار پاسخ‌ها</h4>
                        <p>پاسخ ‌های دریافت شده توسط هر  شرکت کنندگلن در آزمون با توجه به جواب‌ های درستی که در قسمت طراحی سوالات تعیین کرده‌اید توسط سامانه به صورت خودکار تصحیح و نمره هر شرکت‌کننده محاسبه می‌شود  و کارنامه آزمون همراه با جزییات عملکرد هر شخص صادر می گردد. </p>

                    </div>
                </div>
                <!-- end of card 3 -->

                <!-- Card 4 -->
                <div class="card">
                    <img class="card-image" src="data/img/logo/step-report.png" alt="step-answers">
                    <div class="card-body">
                        <h4 class="card-title">مشاهده‌ی آنلاین نتایج و گزارش‌ها</h4>
                        <p>شما به عنوان برگزار کننده آزمون آنلاین می‌توانید در حین برگزاری آزمون و یا بعد از اتمام آن، پاسخ‌ها، نمرات کسب شده را مشاهده کنید. </p>
                    </div>
                </div>
                <!-- end of card 4 -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of services -->

<!-- slider -->
<div class="slider-1 rtl">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h5>ویژگی های آزمون آنلاین:</h5>
                <!--  Slider -->
                <div class="slider-container">
                    <div class="swiper-container image-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> امکان ایجاد سوال تستی و تشریحی</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> تنظیم ساعت و تاریخ شروع و پایان امتحان</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> تنظیم زمان آزمون برای هر سوال یا برای کل آزمون</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> محدود کردن تعداد شرکت کنندگان</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> تنظیم کد اختصاصی ورود به آزمون برای هر نفر</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> امکان ویرایش سوالات تا قبل از تایید نهایی</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> تصحیح خودکار سوالات</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> ایجاد کارنامه برای هر آزمون</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> مشاهده پاسخ شرکت کنندگان در پس از شروع آزمون</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> امکان آپلود دادن عکس برای سوالات</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> نوشتن ساده فرمول های ریاضی</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> کارنامه اختصاصی برای هر نفر</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> امکان ایجاد آزمون های هفتگی،ماهانه،... و درج پیشرفت در کارنامه هر آزمون</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="image-container">
                                    <p><i class="fas fa-check"></i> درج انواع مختلف سوال</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-wrapper -->
                    </div> <!-- end of swiper container -->
                </div> <!-- end of slider-container -->
                <!-- end of image slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-1 -->
<?php
}
?>

<!-- Copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="p-small">Copyright © 2020 <img src="data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px"> All rights reserved  -  <?php built(); ?></p>
            </div> <!-- end of col -->
        </div> <!-- enf of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Scripts -->
<script src="data/style/js/jquery%203.4.1.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="data/style/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
<script src="data/style/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
<script src="data/style/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="data/style/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
<script src="data/style/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
<script src="data/style/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="data/style/js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>

<script>
    $(document).ready(function () {

        $('.spinner-border').hide();

        $('#submit').click(function () {
            var name = $('#name').val();
            var lname = $('#lname').val();
            var excode = $('#excode').val();
            $('#spin1').show();
            $('#submit').hide();
            $.ajax({
                type:"POST",
                url:'user/op/user_control.php',
                data:"sh=1&name="+name+"&lname="+lname+"&excode="+excode
            });
        });


        $('#submit2').click(function () {
            var  incode = $('#in_code2').val();
            var excodee = $('#excode').val();
            $('#spin2').show();
            $('#submit2').hide();
            $.ajax({
                type: "GET",
                url:'user/op/user_control.php',
                data: "sh2=1&in_code2="+incode+"&excode="+excodee
            });
        });

        function amar() {
            var exam=$('#g_exam').val();
            var sh=$('#g_sh').val();
            var i=0;

            setInterval(function () {
                if (i<=exam) {
                    $('#s_exam').delay(500).html("آزمون:  "+i+"+");
                    i++;
                }
            },200);

            var j=0;

            setInterval(function () {
                if (j<=sh){
                    $('#s_sh').delay(500).html("شرکت کننده:  "+j+"+");
                    j++;
                }
            },100);


        }
        amar();

    });
</script>

<!-- افزودن1 -->
<div class="modal fade rtl" id="add1">
    <div class="modal-dialog rtl">
        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">مشخصات</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">
                <label>نام: </label>
                <input type="text"class="form-control"id="name">
                <label>نام خانوادگی: </label>
                <input type="text"class="form-control"id="lname"><br>


            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <section class="d-inline-block">
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal"style="margin-left: 10px;"id="add-close">بستن</button>
                 <a href="azmoon.php"><button class="btn btn-success" id="submit">شروع</button></a>
                </section>
                <section  class="d-inline-block float-left">
                    <div class="spinner-border text-success float-left" style="display: none ;" id="spin1"></div>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- افزودن2 -->
<div class="modal fade rtl" id="add2">
    <div class="modal-dialog rtl">
        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">مشخصات</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">

                <!--                <form action="index.php" method="post">-->
                <label>کد شرکت در آزمون: </label>
                <input type="text" id="in_code2" class="form-control"><br>
                <!--                </form>-->


            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <section class="d-inline-block">
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal"style="margin-left: 10px;"id="add-close">بستن</button>
                    <a href="azmoon.php"><button type="button" class="btn btn-success" id="submit2">شروع</button></a>
                </section>
                <section  class="d-inline-block float-left">
                    <div class="spinner-border text-success float-left" style="display: none ;" id="spin2"></div>
                </section>
            </div>
        </div>
    </div>
</div>
