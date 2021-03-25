<?php
session_start();
if (empty($_SESSION["user"])) {
    header("location: login/log_in.php");
}
require ("../data/db/db.php");
require ("../data/class/jdf.php");
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
<?php
$code=$_SESSION["exam"];
$data3=$connection->prepare("select * from exam where code='$code'");
$data3->execute();
$result3=$data3->fetchAll(PDO::FETCH_ASSOC);
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
            <a class="nav-link " href="user.php" ><i class="fas fa-home"> خانه </i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="add.php" ><i class="fas fa-pencil-alt  text-primary"> آزمون جدید </i></a>
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


<nav class="navbar navbar-expand-sm w3-light-gray fixed-top border-right" style="margin-right: 130px;margin-top: 26px;display: <?php if(isset($_SESSION["exam"]))echo "block"; else echo "none"; ?> ;margin-bottom: 20px;"id="nav2">
    <ul class="navbar-nav"style="padding-right: 0px;">
        <li class="nav-item">
            <a class="nav-link" href="#" id="add"><i class="fas fa-edit" data-toggle="modal" data-target="#add_q"> افزودن سوال</i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#add_date" id="date-time"><i class="fas fa-calendar-alt"> تاریخ برگزاری</i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"data-toggle="modal" data-target="#seting"id="btn-seting"><i class="fas fa-cog"> تنظیمات آزمون</i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-inline-block <?php if ($result3[0]["s"]!=0) echo "text-primary aaa"; ?> " id="auto-s" href="#"><i class="fas fa-magic"> تصحیح خودکار</i></a>
            <?php if ($result3[0]["s"]==0) echo "<i class='far fa-question-circle w3-tooltip d-inline-block'><span class=\"w3-text text-danger \">(<em>در صورت فعال شدن تمام سوالات تشریحی حذف می شود.</em>)</span></i>"; ?>
        </li>
    </ul>
</nav>
<br><br>

<div class="rtl"style="float: left;"id="body1">

    <div id="d_creat"style="display: <?php if(isset($_SESSION["exam"]))echo "none"; else echo "block"; ?>">
        <input type="text"class="form-control" placeholder="نام آزمون را وارد کنید" id="creat_name">
        <p class="text-danger"id="p_creat"style="display: none;">نام آزمون را وارد کنید</p>
        <br>
        <input type="submit"class="btn btn-outline-dark btn-lg"id="creat"value="ایجاد آزمون جدید">
    </div>
    <?php
    if (!empty($_SESSION["exam"])){
    ?>
    <?php
    //$_SESSION["exam"]=null;
    $exam_code=$_SESSION["exam"];
    $data2=$connection->prepare("select * from exam where code='$exam_code'");
    $data2->execute();
    $result2=$data2->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div style="padding-top: 10px;padding-left: 10px;">
        <h2><?php echo $result2[0]["name"]; ?></h2>
        <hr>
        <div id="show"></div>

    </div>

        <a href="#end"><i class="far fa-arrow-alt-circle-down fixed-bottom w3-gray"style="font-size: 25px;margin-right: 80px;margin-bottom: 35px;padding: 3px;width: 31px;border-radius: 5px;"></i></a>

        <hr>

        <div id="end"class="bg-dark alert text-light "style="margin-right: 2px;margin-left: 8px ;height: 70px;float: bottom">
            <a href="final.php"> <button class="btn btn-light btn-lg"id="final">تایید نهایی</button></a>
            <a href="add.php"class="d-inline-block"><button class="btn btn-outline-light btn-lg"id="new_a">ایجاد آزمون جدید</button></a>

            </div>

<?php } ?>
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
            $('#body1').width(w-140);
            $('#nav2').width(w-135);

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

        $('#creat').click(function () {
             var cname=$('#creat_name').val();
           if (cname!="") {
               $.ajax({
                   type: "POST",
                   url: 'op/creat.php',
                   data: "cname=" + cname,
                   success: function (cr) {
                       location.reload();
                       if (cr == 1) {
                           $('#d_creat').hide(200);
                           $('#nav2').show(200);
                       } else {
                           alert("مشکلی در ارسال داده ها به وجود آمده است. ");
                       }
                   }
               });
           }else {
                $('#p_creat').show();
           }
        });

        $('#add').click(function () {
            addh();
            $.ajax({
                type: "POST",
                url: 'op/control.php',
                data: "q-type-show=1",
                success:function (qts) {
                    if (qts==1){
                        $('#add_type').hide();
                        $('#add-1').show();
                        $('#add-1-s').show();
                        $('#add-clear').show();
                    }else {
                        $('#add_type').show();
                        $('#add-1').hide();
                        $('#add-1-s').hide();
                        $('#add-clear').hide();
                        $('#change-type').hide();
                        $('#add-warning').hide();
                    }
                }
            });
        });

        $('#submit_type').click(function () {
            var st=$('#exam_type').val();
            if (st==1){
                $('#add_type').hide(100);
                $('#add-1').show(100);
                $('#add-1-s').show(100);
                $('#change-type').show(100);
                $('#add-clear').show(100);
            }
            if (st==2){
                $('#add_type').hide(100);
                $('#add-2').show(100);
                $('#add-2-s').show(100);
                $('#change-type').show(100);
                $('#add-clear').show(100);
            }
        });

        $('#change-type').click(function () {
            $('#add_type').show(100);
            $('#add-2').hide(100);
            $('#add-2-s').hide(100);
            $('#add-1').hide(100);
            $('#add-1-s').hide(100);
            $('#change-type').hide(100);
            $('#add-clear').hide(100);
        });

        $('#add-clear').click(function () {
            $('#q-1').val("");
            $('#a-1-1').val("");
            $('#a-1-2').val("");
            $('#a-1-3').val("");
            $('#a-1-4').val("");
            $('#q-2').val("");
        });

        $('#add-1-s').click(function () {
            var add1q=$('#q-1').val();
            var add11=$('#a-1-1').val();
            var add12=$('#a-1-2').val();
            var add13=$('#a-1-3').val();
            var add14=$('#a-1-4').val();
            var ad1c=$('#ad-1-c').val();
            if (add1q != "" && add11 != "" && add12 != "" && add13 != "" && add14!=""){
                $.ajax({
                    type:"POST",
                    url:'op/control.php',
                    data:"add1=1&add1g="+add1q+"&add11="+add11+"&add12="+add12+"&add13="+add13+"&add14="+add14+"&ad1c="+ad1c,
                    success:function (add1s) {
                        ref();
                        $('#add-suc').show(500);
                        $('#add-suc').delay(1500).fadeOut(500);
                        if (add1s==1){
                            $('#add-clear').trigger("click");
                        }
                        if (add1s==0){
                            alert("مشکلی در ارسال داده ها پیش آمده است. ")
                        }
                    }
                });
            } else {
                $('#add-warning').show(100);
            }
        });

        $('#add-2-s').click(function () {
            var q2=$('#q-2').val();
            $.ajax({
                type:"POST",
                url:'op/control.php',
                data:"add2=1&q2="+q2,
                success:function (add1s) {
                    ref();
                    $('#add-suc').show(500);
                    $('#add-suc').delay(1500).fadeOut(500);
                    if (add1s==1){
                        $('#add-clear').trigger("click");
                    }
                    if (add1s==0){
                        alert("مشکلی در ارسال داده ها پیش آمده است. ")
                    }
                }
            });
        });


        function ref(){
            $.ajax({
               type:"POST",
               url:"op/control.php",
               data:"ref=1",
               success:function (ref) {
                   $('#show').html(ref);
               } 
            });
        }
        ref();


        $('#time-submit').click(function () {
            var dates=$('#date-s').val();
            var datee=$('#date-e').val();
            var times=$('#time-s').val();
            var timee=$('#time-e').val();
            var timee2=timee;

            if (dates<datee || dates==datee && timee>times){

                    $.ajax({
                        type: "POST",
                        url: 'op/control.php',
                        data: "date_time=1&dates=" + dates + "&datee=" + datee + "&times=" + times + "&timee" + timee + "&ok=" + timee,
                        success: function () {
                            $("#date-close").trigger("click");
                        }
                    });

            } else {
                $('#time-warning').show(500);
                $('#time-warning').delay(3000).fadeOut(500);
            }
        });
        
        
        $('#date-time').click(function () {
            $.ajax({
                type:"POST",
                url:'op/control.php',
                data:"set_time_date=1",
                success:function (sseett) {
                    $('#show-date-time').html(sseett);
                }
            });
        });
        
        $('#time-f-q').click(function () {
            $('#time-f-all-form').hide();
            $('#time-f-q-form').show();
        });
        $('#time-f-all').click(function () {
            $('#time-f-all-form').show();
            $('#time-f-q-form').hide();
        });

        function anum(){
            $('#a-nun-ch').on('change', function() {
                if ($(this).is(':checked')) {
                    $("#a-num-div").show(100);
                } else {
                    $("#a-num-div").hide(100);
                }
            });
        }


        $('#a-nun-ch').click(function () {
            anum();
        });

        function shsetcode(){
            $('#sh_set_code').on('change', function() {
                if ($(this).is(':checked')) {
                    $("#div-sh-set-code").show(100);
                } else {
                    $("#div-sh-set-code").hide(100);
                }
            });
        }

        $('#sh_set_code').click(function () {
            shsetcode();
        });


        $('#auto-s').click(function () {
            $.ajax({
                type:"POST",
                url:'op/control.php',
                data:"auto_s=1",
                success:function () {
                    $('#auto-s').toggleClass("text-primary");
                    $('#auto-s').toggleClass("aaa");
                }
            });
        });

        $('#btn-ref-page').click(function () {
            location.reload();
        });


        $('#new_a').click(function () {
            $.ajax({
                type:"POST",
                url:'op/control.php',
                data:"new_a=1"
            });
        });

    });

</script>

<!-- افزودن -->
<div class="modal fade rtl" id="add_q">
    <div class="modal-dialog rtl">
        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">افزودن سوال</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">

                <div id="add_type"class="row">
                    <label class="col-12">نوع سوال: </label>
                    <br>
                    <select id="exam_type"class="form-control col-6"style="margin-right: 20px;margin-left: 5px">
                        <option value="1">تستی</option>
                        <option value="2">تشریحی</option>
                    </select>
                    <input type="submit"value="تایید"id="submit_type"class="btn btn-outline-primary col-2">
                </div>

                <div id="add-1"style="display: none">
                    <label>سوال:</label>
                    <input type="text"id="q-1"class="form-control">
                    <label>جواب ها: </label>
                    <input type="text"id="a-1-1"class="form-control"placeholder="گزینه یک">
                    <input type="text"id="a-1-2"class="form-control"placeholder="گزینه دو">
                    <input type="text"id="a-1-3"class="form-control"placeholder="گزینه سه">
                    <input type="text"id="a-1-4"class="form-control"placeholder="گزینه چهار">
                    <label>گزینه صحیح: </label>
                    <select id="ad-1-c"class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div id="add-2"style="display: none">
                    <label>سوال: </label>
                    <input type="text"id="q-2"class="form-control">
                </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal"style="margin-left: 10px;"id="add-close">بستن</button>
                <button class="btn btn-info"id="change-type"style="display: none">تغییر</button>
                <button class="btn btn-success"id="add-1-s"style="display: none">ذخیره</button>
                <button class="btn btn-success"id="add-2-s"style="display: none">ذخیره</button>
                <button class="btn btn-light"id="add-clear"style="display: none">پاک کردن</button>
                <p class="text-danger bg-warning" style="display: none;margin-top: 10px"id="add-warning">تمامی موارد باید پر شوند. </p>
                <i class="far fa-save text-success"id="add-suc"style="font-size: 20px;margin-top: 7px;display: none;">ذخیره شد</i>
            </div>
        </div>
    </div>
</div>


<!-- تاریخ -->
<div class="modal fade rtl" id="add_date">
    <div class="modal-dialog rtl">
        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">تاریخ برگزاری امتحان</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">
                <div id="show-date-time">
                    v
                </div>
                <hr>
                <div id="change-date-time">
                <div class="row container">
                    <i class="fas fa-exclamation-triangle text-danger"id="time-warning"style="display: none;">لطفا در انتخاب تاریخ و ساعت شروع و پایان دقت داشته باشید.</i>
                    <br>
                    <label class="col-5"style="padding-right: 0px;">تاریخ شروع: </label>
                <label class="col-5"style="padding-right: 5px;">تاریخ پایان: </label>
                    <?php
                    $today=time();
                    ?>
                    <select id="date-s"class="form-control col-5"style="margin-left: 5px;">
                        <option value="<?php echo $today; ?> "><?php echo jdate("ldFo",$today); ?> </option>
                        <option value="<?php echo $today+86400; ?> "><?php echo jdate("ldFo",$today+86400); ?> </option>
                        <option value="<?php echo $today+172800; ?> "><?php echo jdate("ldFo",$today+172800); ?> </option>
                        <option value="<?php echo $today+259200; ?> "><?php echo jdate("ldFo",$today+259200); ?> </option>
                        <option value="<?php echo $today+345600; ?> "><?php echo jdate("ldFo",$today+345600); ?> </option>
                        <option value="<?php echo $today+432000; ?> "><?php echo jdate("ldFo",$today+432000); ?> </option>
                        <option value="<?php echo $today+818400; ?> "><?php echo jdate("ldFo",$today+518400); ?> </option>
                    </select>
                    <select id="date-e"class="form-control col-5">
                        <option value="<?php echo $today; ?> "><?php echo jdate("ldFo",$today); ?> </option>
                        <option value="<?php echo $today+86400; ?> "><?php echo jdate("ldFo",$today+86400); ?> </option>
                        <option value="<?php echo $today+172800; ?> "><?php echo jdate("ldFo",$today+172800); ?> </option>
                        <option value="<?php echo $today+259200; ?> "><?php echo jdate("ldFo",$today+259200); ?> </option>
                        <option value="<?php echo $today+345600; ?> "><?php echo jdate("ldFo",$today+345600); ?> </option>
                        <option value="<?php echo $today+432000; ?> "><?php echo jdate("ldFo",$today+432000); ?> </option>
                        <option value="<?php echo $today+818400; ?> "><?php echo jdate("ldFo",$today+518400); ?> </option>
                    </select>

                </div>

                <div class="row container" >
                    <label class="col-5"style="padding-right: 0px;">ساعت شروع: </label>
                    <label class="col-5"style="padding-right: 5px;">ساعت پایان: </label>
                    <select id="time-s" class="form-control col-5">
                        <?php
                        date_default_timezone_set("Asia/Tehran");
                        for ($i=1;$i<=24;$i++){
                            echo "<option value='".$i."'>".$i.":00</option>";
                        }
                        ?>
                    </select>

                    <select id="time-e" class="form-control col-5"style="margin-right: 5px;">
                        <?php
                        for ($j=1;$j<=24;$j++){
                            echo "<option value='".$j."'>".$j.":00</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>


            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <button type="button" class="btn btn-danger float-right"  data-dismiss="modal"style="margin-left: 10px;"id="date-close">بستن</button>
                <button class="btn btn-success" id="time-submit">ذخیره</button>
            </div>
        </div>
    </div>
</div>
<!-- تنظیمات -->
<div class="modal fade rtl" id="seting">
    <div class="modal-dialog rtl">

        <div class="modal-content rtl">
            <!-- Modal Header -->
            <div class="modal-header text-right d-inline-block">
                <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center float-right">تنظیمات آزمون</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body rtl">

                <div id="time-f-set">
                <label>مدت زمان آزمون: </label>
                    <?php
                    if ($result3[0]["t"]=="0")
                        echo "ثبت نشده است. ";
                    else{
                        $zman=explode("-",$result3[0]["t"]);
                        switch ($zman[0]){
                            case 1:
                                echo $zman[1]." دقیقه برای کل آرمون";
                                break;
                            case 2:
                                echo $zman[1]." ثانیه برای هر سوال";
                        }
                    }
                    ?>
                    <br>
                <div class="form-check-inline">
                    <label class="form-check-label" for="time-f-all">
                        <input type="radio" class="form-check-input" id="time-f-all" name="optradio" value="option1" checked>زمان برای کل آزمون
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="time-f-q">
                        <input type="radio" class="form-check-input" id="time-f-q" name="optradio" value="option2">زمان برای هر سوال
                    </label>
                </div>
                <br><br>
                    <form action="add.php"method="post"id="time-f-all-form">
                        <input type="text"class="form-control col-6"placeholder="زمان به دقیقه"id="time-f-all-t"name="time-f-all-t">
                        <br>
                        <input type="submit"class="btn btn-success"value="ذخیره"id="time-f-all-submit"name="time-f-all-submit">
                    </form>
                    <form action="add.php"method="post"id="time-f-q-form"style="display: none">
                        <input type="text"class="form-control col-6"placeholder="زمان به ثانیه"id="time-f-q-t"style=""name="time-f-q-t">
                        <br>
                        <input type="submit"class="btn btn-success"value="ذخیره"id="time-f-q-submit"style=""name="time-f-q-submit">
                    </form>
                    <?php
                    if (isset($_POST["time-f-all-submit"])){
                        $time_f_all_t=htmlspecialchars($_POST["time-f-all-t"]);
                        $qu1="1-".$time_f_all_t;
                        mysqli_query($cdb,"UPDATE `exam` SET `t`='$qu1' WHERE code='$code'");
                    }
                    if (isset($_POST["time-f-q-submit"])){
                        $time_f_q_t=htmlspecialchars($_POST["time-f-q-t"]);
                        $qu2="2-".$time_f_q_t;
                        $data5=$connection->prepare("UPDATE `exam` SET `t`='$qu2' WHERE code='$code'");
                        $data5->execute();
                    }
                    ?>
                </div>
                <hr>

                <div class="sh_set_code">
                    <label>تنظیم کد دسترسی برای شرکت کنندگان: </label>
                    <label class="switch">
                        <input type="checkbox"<?php if ($result3[0]["num"]=="a") echo "checked"; ?> id="sh_set_code">
                        <span class="slider round"></span>
                    </label>
                    <div id="div-sh-set-code" style=" <?php if ($result3[0]["num"]=="a") echo "display:"; else echo "display:none" ?>">
                        <?php
                        $data6=$connection->prepare("select * from accesscode where excode='$code'");
                        $data6->execute();
                        $count_sh_set_code=$data6->rowCount();
                        if ($count_sh_set_code==0) {
                            ?>
                            <a href="op/code_list.php?creat=<?php echo $code; ?>">
                                <button class="btn btn-primary">ایجاد لیست</button>
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="op/code_list.php?creat=<?php echo $code; ?>">
                                <button class="btn btn-primary">نمایش لیست</button>
                            </a>
                            <?php
                        }
                        ?>
                    </div>

                </div>
                <hr>

                <div id="a-num" style="display: <?php if ($result3[0]["num"]=="a") echo "none;"; ?>">
                    <label>محدود کردن تعداد شرکت کنندگان: </label>
                    <label class="switch">
                        <input type="checkbox"<?php if ($result3[0]["num"]!=0 && $result3[0]["num"]!="a") echo "checked"; ?> id="a-nun-ch">
                        <span class="slider round"></span>
                    </label>

                    <div id="a-num-div" style="display:<?php if ($result3[0]["num"]==0) echo "none"; ?> ">
                        <p><?php if ($result3[0]["num"]!=0)echo $result3[0]["num"]." نفر قادر به شرکت در آزمون هستند. "; ?> </p>
                        <form action="add.php"method="post">
                            <input type="number"name="a_num_text"class="form-control"min="1" value="<?php if ($result3[0]["num"]==0) echo "1"; else echo $result3[0]["num"]; ?>"><br>
                            <input type="submit"name="a_num_submit"id="a_num_submit" value="ذخیره"class="btn btn-success">
                        </form>
                        <?php
                        if (isset($_POST["a_num_submit"])){
                            $a_num_text=htmlspecialchars($_POST["a_num_text"]);
                            if ($a_num_text>0) {
                                mysqli_query($cdb, "UPDATE `exam` SET `num`='$a_num_text' WHERE code='$code'");
                            }else{
                                echo "<script>alert(' کمتر از یک مجاز نیست')</script>";
                            }
                        }
                        ?>
                    </div>

                </div>
                <hr>
                <div>
                    <label>ویرایش نام آزمون: </label>
                    <form action="add.php"method="post">
                        <input type="text"name="a_name"class="form-control"value="<?php echo $result3[0]["name"]; ?>">
                        <br>
                        <input type="submit"name="a_name_submit"class="btn btn-success"value="ذخیره">
                    </form>
                    <?php
                    if (isset($_POST["a_name_submit"])){
                        $a_name=$_POST['a_name'];
                        mysqli_query($cdb,"UPDATE `exam` SET `name`='$a_name' WHERE code='$code'");
                    }
                    ?>
                </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer rtl d-inline-block">
                <button type="button" class="btn btn-danger float-right"  data-dismiss="modal"style="margin-left: 10px;"id="date-close">بستن</button>
                <button class="btn btn-light" id="btn-ref-page">رفرش کردن صفحه</button>
                <i class="w3-tooltip far fa-question-circle d-inline-block"style="font-size: 20px;margin-top: 6px;"> <span class="w3-text">(<em>در صورت مشاهده نکردن تغییرات صفحه را رفرش کنید. </em>)</span></i>
            </div>
        </div>
    </div>
</div>
