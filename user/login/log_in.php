<!doctype html>
<?php
session_start();
if (!empty($_SESSION["user"])) {
    header("location: ../user.php");
}
require ("../../data/db/db.php");
?>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../data/style/css/bootstrap.min.css">
    <script src="../../data/style/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../../data/style/js/jquery%203.4.1.js"></script>
    <link rel="stylesheet" href="../../data/style/css/log.css">
    <link rel="stylesheet" href="../../data/style/font/font.css">
    <link rel="shortcut icon" href="../../data/img/logo/آزمون%20آنلاین.png" title="ورود" />
    <title>ورود</title>
</head>
<body >

<div class="wrapper">
    <div class="container">
        <h1>ورود به پنل کاربری</h1>

        <form class="form" method="post" action="log_in.php">
            <input type="text" name="usern" placeholder="نام کاربری"id="usern">
            <input type="password" placeholder="رمز عبور"name="pass"id="pass">
            <button type="submit" id="login-button" name="submit">ورود</button><br>
            <a href="../../admin/login/signup.php" class="btn  text-light" >درخواست عضویت</a>

        </form>
        <?php
        if (isset($_POST["submit"])){
            $usern=htmlspecialchars($_POST["usern"]);
            $pass=htmlspecialchars($_POST["pass"]);

 //           $row=mysqli_query($cdb,"SELECT * FROM admin") ;
//            $rusern=$result["username"];
//            $rpass=$result["password"];
           $db = $connection->prepare("SELECT * FROM users");
            $db->execute();
            $data = $db->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($usern) and !empty($pass)){

            foreach ($data as $result){
                if ($usern==$result["username"] && $pass==$result["password"]){
                    $_SESSION["user"]=$usern;
                    header("location: ../user.php");
                }
            }
                echo "یوسرنام یا پسورد وارد شده معتبر نیست";
            }else
                echo "تمامی موارد باید پر شوند";
        }
        ?>

    </div>

    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>


</body>
</html>
