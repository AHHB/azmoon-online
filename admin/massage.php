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
<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        text-align: center;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: right;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        width: 100px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        width: 100%;
    }


    #myInput {
        width: 150px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    #myInput:focus {
        width: 85%;
    }
    .finger:hover{
        cursor: pointer;
    }



</style>
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
            <a class="nav-link " href="admin.php" ><i class="fas fa-home "> خانه </i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="users.php" ><i class="fas fa-user"> اعضا </i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="massage.php"><i class=" fas fa-envelope text-primary"> پیام ها </i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="setting.php"><i class="fas fa-wrench"> تنظیمات </i></a>
        </li>
    </ul>
</nav>
<div class="rtl"style="float: left;"id="body1">
    <?php
    $data2=$connection->prepare("select * from massage ");
    $data2->execute();
    $result2=$data2->fetchAll();

    $data3=$connection->prepare("select * from massage where sh='0'");
    $data3->execute();
    $new=$data3->rowCount();
    $result3=$data3->fetchAll()
    ?>

    <div class="row"style="margin-top: 0px;">
        <div class="tab text-center"style="margin-right: 7px;width: 100%;">
            <button class="tablinks active" onclick="openCity(event, 'all')">همه</button>
            <button class="tablinks" onclick="openCity(event, 'new')">جدید<?php if ($new!=0) echo "<span class=\"badge badge-secondary\"style='margin-right: 5px;margin-bottom: 5px;'>".$new."</span>"; ?></button>
        </div>

        <!-- Tab content -->


        <div id="all" class="tabcontent">

            <ul class="list-group" style="padding-right: 0px;margin-left: 7px">
                <?php
                foreach ($result2 as $l1){
                    echo "<li class=\"list-group-item\"><i class='far fa-envelope'>"." ".$l1["name"]."</i><p style='font-size: 10px;margin-bottom: 0px'>".$l1["email"]."</p><hr style='margin: 5px;'><p>".$l1["text"]."</p></li>";
                }
                ?>
            </ul>

        </div>

        <div id="new" class="tabcontent"style="display: none;">
            <ul class="list-group" style="padding-right: 0px;margin-left: 7px">
                <?php
                foreach ($result3 as $l1){
                    echo "<li class=\"list-group-item\"><i class='far fa-envelope'>"." ".$l1["name"]."</i><p style='font-size: 10px;margin-bottom: 0px'>".$l1["email"]."</p><hr style='margin: 5px;'><p>".$l1["text"]."</p></li>";
                }
                $data4=$connection->prepare("UPDATE `massage` SET `sh`='1'");
                $data4->execute();
                ?>
            </ul>
        </div>

        <br>


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


    function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

</script>