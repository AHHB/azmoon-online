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
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="جست و جو"aria-placeholder="ff" class="form-control d-inline-block ">
    <i class="fas fa-search d-inline-block text-secondary"></i>
    <br><br>
    <?php
    $data2=$connection->prepare("select * from exam where end='1' and username='$usern'");
    $data2->execute();
    $result2=$data2->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table id="myTable"class="rtl table table-hover table-striped">
        <tr class="">
            <th class="col-11">نام آزمون: </th>
            <th class="col-1"></th>
        </tr>
        <?php
        foreach ($result2 as $l1) {
            ?>
            <tr >
                <td class="col-11 "id="tr"><a href="azmoon_view.php?code=<?php echo $l1["code"];?>"class="text-dark"style="padding-left: 85%"><?php echo $l1["name"]; ?></a>  </td>
                <td class="col-1"><a href="#"class="d-inline-block del"id="del-<?php echo $l1["code"];?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php
        }
        ?>

    </table>

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


        $('.del').click(function () {
            var del = $(this).attr("id");
            $.ajax({
                type: "GET",
                url: 'op/user_control.php',
                data: "mdel=1&deel="+del,
                success:function () {
                    location.reload();
                }
            });
        });

    });

    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>