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

<?php

?>
<div class=" rtl">
    <?php
    if ($_SESSION["sh"]=="")
        header("location: index.php");

    $code=$_SESSION["sh"];
    $data=$connection->prepare("select * from sh where code='$code'");
    $data->execute();
    $result=$data->fetchAll(PDO::FETCH_ASSOC);

    $excode=$result[0]["excode"];
    $data2=$connection->prepare("select * from exam where code='$excode'");
    $data2->execute();
    $result2=$data2->fetchAll(PDO::FETCH_ASSOC);
    $row=$data2->rowCount();
    $_SESSION["sh"]=null;
    ?>
<div class="jumbotron">
    <h1 class="mx-auto font-weight-bold"style="width: 200px;font-size: 50px;"><b>پایان آزمون</b></h1>
    <hr>
    <h6 style="width: 250px;"class="mx-auto text-center"><i class="fas fa-user" ><?php echo $result[0]["name"]." ".$result[0]["lname"]; ?> </i></h6>

</div>



</div>

<footer class="fixed d-inline-block text-center"style="width: 100%;">
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

