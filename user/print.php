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
    <script src="../data/class/jQuery.print.js"></script>
    <link rel="stylesheet" href="../data/style/css/w3.css">
    <link rel="stylesheet" href="../data/style/font/font.css">
    <link rel="stylesheet" href="../data/style/css/main_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>
</head>
<body>
<div id="overlay"class="text-center">
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
$sh_count=$data4->rowCount();
$result4=$data4->fetchAll(PDO::FETCH_ASSOC);

$t=explode("-",$result2[0]["t"]);
?>

<div class="rtl "style="float: left;"id="body1">
    <br>
    <a href="azmoon_view.php?code=<?php echo $code;?>"><button class="btn"><i class="fas fa-arrow-alt-circle-right "> بازگشت </i></button></a>
    <hr>

    <div class="container">
        <label>کارنامه کل شرکت کنندگان: </label>
        <button class="btn btn-outline-dark"id="print-all-k"><i class="fas fa-print"></i></button>
        <br><br>
        <div id="master-k">
            <table class="rtl table table-bordered">
                <tr class="header text-center">
                    <th><img src="../data/img/logo/آزمون%20آنلاین.png" alt="logo"class="img-fluid"style="height: 100px;"></th>
                </tr>
                <tr class="text-center ">
                    <th>کارنامه کل شرکت کنندگان</th>
                </tr>
                <tr class="row container">
                    <th class="col-6"><?php echo "نام آرمون:  ".$result2[0]["name"]; ?> </th>
                    <th class="col-6"><?php echo "نام برگزار کننده آرمون:  ".$result1[0]["name"]." ".$result1[0]["lname"]; ?></th>
                </tr>
                <tr class="container row">
                    <th class="col-4"><?php echo "تعداد سوالات: ".$qu_count; ?></th>
                    <th class="col-4"><?php if ($t[0]==1) echo "زمان آزمون: ".$t[1]." دقیقه"; else echo "زمان آزمون: ".$t[1]." ثانیه برای هر سوال"; ?></th>
                    <th class="col-4"><?php echo "تعداد شرکت کنندگان: ".$sh_count." نفر"; ?></th>
                </tr>
                <tr class="container row">
                    <th class="col-6">نام و نام خانوادگی شرکت کنده </th>
                    <th class="col-2 text-center">صحیح</th>
                    <th class="col-2 text-center">غلط</th>
                    <th class="col-2 text-center">بدون پاسخ</th>
                </tr>
                <?php
                foreach ($result4 as $l1){
                    $s=0;
                    $g=0;
                    $ng=0;

                    $a1=explode("|",$l1["a"]);
                    for ($i=0;$i<$qu_count;$i++){
                        $a2=explode("-",$a1[$i]);
                        $query2 = $a2[0];
                        $da2 = $connection->prepare("select * from qu where id='$query2'");
                        $da2->execute();
                        $res=$da2->fetchAll(PDO::FETCH_ASSOC);

                            if ($a2[2]<5){
                                if ($res[0]["c"]==$a2[2]){
                                    $s++;
                                }else{
                                    $g++;
                                }
                            }else
                                $ng++;

                    }
                    ?>
                    <tr class="container row">
                        <td class="col-6"><?php echo $l1["name"]." ".$l1["lname"];?></td>
                        <td class="col-2 text-center"><?php echo $s; ?> </td>
                        <td class="col-2 text-center"><?php echo $g; ?></td>
                        <td class="col-2 text-center"><?php echo $ng; ?></td>
                    </tr>
                    <?php
                }
                ?>

            </table>
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
            var w=$(window).width();
            var h=$(window).height();
            $('#body1').width(w);

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

        $('#print-all-k').click(function () {
            $.print('#master-k')
        });

    });
</script>