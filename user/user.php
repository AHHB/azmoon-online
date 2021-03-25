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
$usern=$_SESSION["user"];
$data1=$connection->prepare("select * from users where username='$usern'");
$data1->execute();
$result1=$data1->fetchAll(PDO::FETCH_ASSOC);


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
            <a class="nav-link " href="user.php" ><i class="fas fa-home text-primary"> خانه </i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="add.php" ><i class="fas fa-pencil-alt"> آزمون جدید </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="azmoon_management.php"><i class=" fas fa-clipboard-check"> مدیریت آزمون </i></a>
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

    <div class="row"style="margin-top: 25px;">
        <div class="col-1"></div>
        <div class="w3-light-grey col-4 text-center"style="border-radius: 10px;">
            <h6>آزمون های برگزار شده:</h6>
            <?php
            $data3=$connection->prepare("select * from exam where end='1' and username='$usern'");
            $data3->execute();
            $exam_count=$data3->rowCount();
            $result3=$data3->fetchAll(PDO::FETCH_ASSOC);
            echo "<p>".$exam_count." آزمون"."</p>";
            ?>
        </div>
        <div class="col-2"></div>
        <div class="w3-light-grey col-4 text-center "style="border-radius: 10px;">
            <h6>شرکت کنندگان در آزمون ها: </h6>
            <?php
            $sh_count=0;
            foreach ($result3 as $l1){
                $l1_qua=$l1["code"];
                $data4=$connection->prepare("select * from sh where excode='$l1_qua'");
                $data4->execute();

                $sh_count=$sh_count+$data4->rowCount();
            }
            echo " <p>".$sh_count." نفر"."</p>"
            ?>
        </div>
        <div class="col-1"></div>
    </div>

    <div style="border: 1px black solid;border-radius: 5px;margin-left: 5px;margin-top: 35px;padding: 5px;">
        <h6 style="background-color:white;width:143px;margin-top: -15px;margin-right: 5px;margin-bottom: 10px;"> آزمون های در صف برگزاری: </h6>
        <?php
        $n_count=0;
        $today=time();
        $today2=time();
        $today2=$today2-5400;
        foreach ($result3 as $l2){
            $d=explode("-",$l2["date"]);
            if ($d[0]>=$today2 && $d[1]<$today  ){
                ?>
                <div class="alert alert-secondary">
                    <h5 class="d-inline-block"><?php echo $l2["name"]; ?> </h5>
                    <a href="user.php"class="d-inline-block float-left a-editing-del"id="aed-<?php echo $l2["id"]; ?>"><i class="fas fa-eraser">حذف</i></a>
                </div>
                <?php
                $n_count++;
            }
        }
        if ($n_count==0){
            echo "<p class=\"bg-secondary mx-auto text-light\"style=\"border-radius: 5px;width: 110px;opacity: 0.5;\">هیچ آرمونی وجود ندارد. </p>";
        }
        ?>
    </div>

    <div style="border: 1px black solid;border-radius: 5px;margin-left: 5px;margin-top: 35px;padding: 5px;">
        <h6 style="background-color:white;width:140px;margin-top: -15px;margin-right: 5px;margin-bottom: 10px;"> آزمون های در حال ویرایش: </h6>
        <?php
        $data2=$connection->prepare("select * from exam where end='0' and username='$usern'");
        $data2->execute();
        $result2=$data2->fetchAll(PDO::FETCH_ASSOC);
        $a_editing=$data2->rowCount();
        foreach ($result2 as $loop1){
        ?>
        <div class="alert alert-secondary">
            <h5 class="d-inline-block"><?php echo $loop1["name"]; ?> </h5>
            <a href="user.php"class="d-inline-block float-left a-editing-del"id="aed-<?php echo $loop1["id"]; ?>"><i class="fas fa-eraser">حذف</i></a>
            <a href="add.php"class="d-inline-block float-left a-editing-edit"id="aee-<?php echo $loop1["id"]; ?>" style="margin-left: 5px"><i class="fas fa-pencil-alt">ویرایش</i></a>
        </div>
        <?php
        }
        if ($a_editing==0)
            echo "<p class=\"bg-secondary mx-auto text-light\"style=\"border-radius: 5px;width: 110px;opacity: 0.5;\">هیچ آرمونی وجود ندارد. </p>";

        ?>
    </div>

    <div style="border: 1px black solid;border-radius: 5px;margin-left: 5px;margin-top: 35px;padding: 5px;">
        <h6 style="background-color:white;width:85px;margin-top: -15px;margin-right: 5px;margin-bottom: 10px;"> آزمون های اخیر: </h6>
        <?php
        if ($exam_count==0){
            echo "<p class=\"bg-secondary mx-auto text-light\"style=\"border-radius: 5px;width: 110px;opacity: 0.5;\">هیچ آرمونی وجود ندارد. </p>";
        }
        $ten=0;
        foreach ($result3 as $l3){
            ?>
            <div class="alert alert-secondary">
                <h5 class="d-inline-block"><?php echo $l3["name"]; ?> </h5>
                <a href="user.php"class="d-inline-block float-left a-editing-del"id="aed-<?php echo $l3["id"]; ?>"><i class="fas fa-eraser">حذف</i></a>
                <a href="#"class="d-inline-block float-left a-editing-edit link"id="<?php echo $l3["code"]; ?>" style="margin-left: 5px"><i class=" far fa-clone">لینک آزمون</i></a>
                <input type="text"id="i<?php echo $l3["code"]; ?>"value="<?php echo "http://azmoon-online.gigfa.com/"."index.php?ex=".$l3["code"]; ?>"class="float-left"style="margin-left: 5px;border: none;border-radius: 5px;background-color: #E2E3E5;color: #E2E3E5;">
            </div>
            <?php
            $ten++;
            if ($ten==10)
                break;
        }
        ?>
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
       setInterval(size,1000);


       $('.a-editing-del').click(function () {
           var aedi=$(this).attr("id");
           $.ajax({
               type:"POST",
               url:'op/user_control.php',
               data:"aedi="+aedi
           });
       });

       $('.a-editing-edit').click(function () {
           var aeei=$(this).attr("id");
           $.ajax({
               type:"POST",
               url:'op/user_control.php',
               data:"aeei="+aeei
           });
       });

       $('.link').click(function () {
           var co=$(this).attr("id");
           $('#i'+co).select();
           document.execCommand("copy")
       });



    });

</script>