<?php
require ("../../data/db/db.php");
?>
<!doctype html>
<html lang="fa"dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../data/style/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../data/style/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../../data/style/js/jquery%203.4.1.js"></script>
    <script src="../../data/style/js/main_js.js"></script>
    <link rel="stylesheet" href="../../data/style/css/w3.css">
    <link rel="stylesheet" href="../../data/style/font/font.css">
    <link rel="stylesheet" href="../../data/style/css/main_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>
</head>
<body>
<nav class="navbar navbar-expand-sm w3-light-gray sticky-top">
    <form action="edit.php"method="post">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="../add.php"class="nav-link"><i class="fas fa-arrow-alt-circle-right "> بازگشت </i></a>
            </li>
        </ul>
    </form>
</nav>

<?php
if (isset($_GET["creat"])){
    $creat_code=htmlspecialchars($_GET["creat"]);
    $dat1=$connection->prepare("UPDATE `exam` SET `num`='a' WHERE code='$creat_code'");
    $dat1->execute();
    ?>
    <div class="rtl"style="margin: 10px;">
        <h3>افزودن کد دسترسی: </h3>
        <label>نام: </label>
        <input type="text"id="creat-code-name"class="form-control col-3 d-inline-block">
        <label>کد دسترسی: </label>
        <input type="text"id="creat_code-code"class="form-control col-3 d-inline-block">
        <button class="btn btn-outline-primary d-inline-block"id="creat-code-add"><i class=" fas fa-plus"></i></button>
        <i class="spinner-border text-info"style="margin-bottom: -5px;display: none;"id="spi"></i>
    </div>
    <hr>
    <div id="creat-code-show">

    </div>
    <?php
}
?>

    <script>
        $(document).ready(function () {

            $('#creat-code-add').click(function () {
                var name=$('#creat-code-name').val();
                var code=$('#creat_code-code').val();
                $('#spi').show();
                $.ajax({
                    type: "POST",
                    url: "control.php",
                    data: "creatcode=1&name="+name+"&code="+code,
                    success:function () {
                        $('#spi').hide();
                        $('#creat-code-name').val("");
                        $('#creat_code-code').val("");
                        show();
                    }
                });
            });


            function show() {
                $.ajax({
                    type: "POST",
                    url: 'control.php',
                    data: "shcodeshow=1",
                    success:function (sho) {
                        $('#creat-code-show').html(sho);
                    }
                });
            }

            show();


            $('.del').click(function () {
               // var delid = $(this).attr("id");
                alert("dfg");
            });

        });
    </script>



<footer class="fixed-bottom d-inline-block text-center">
    <hr class="text-secondary">
    <img src="../../data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px">
    <p class="text-secondary d-inline-block"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>