<?php
require ("../../data/db/db.php");
session_start();
    $id = $_GET["id"];
    $_SESSION["add_edit"] = $id;
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
            <input type="submit" name="back" class="btn btn-dark" value="بازگشت" >
        </li>
    </ul>
    </form>
</nav>
<?php
if (isset($_POST["back"])){
    $_SESSION["add_edit"]=null;
    header("location: ../add.php");
}

?>
<?php
$dat=$connection->prepare("select * from qu where id='$id'");
$dat->execute();
$res=$dat->fetchAll(PDO::FETCH_ASSOC);

if ($res[0]["type"]==1) {
    ?>
    <div class="container rtl">
        <label>سوال:</label>
        <input type="text" id="q-1" class="form-control" value="<?php echo $res[0]["q"]; ?> ">
        <?php
        $a = explode("-", $res[0]["a"]);
        ?>
        <label>جواب ها: </label>
        <input type="text" id="a-1-1" class="form-control" placeholder="گزینه یک" value="<?php echo $a[0]; ?> ">
        <input type="text" id="a-1-2" class="form-control" placeholder="گزینه دو" value="<?php echo $a[1]; ?> ">
        <input type="text" id="a-1-3" class="form-control" placeholder="گزینه سه" value="<?php echo $a[2]; ?> ">
        <input type="text" id="a-1-4" class="form-control" placeholder="گزینه چهار" value="<?php echo $a[3]; ?> ">
        <?php echo "گزینه صحیح: " . $res[0]["c"]; ?><br>
        <label>ویرایش گزینه صحیح: </label>
        <select id="ad-1-c" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>
        <input type="submit" id="submit" value="ذخیره" class="btn btn-success">
        <br><br>
        <div class="alert alert-success" id="add-edit-alert" style="display: none;">
            تغییرات با موفقیت ذخیره شد.در صورت مشاهده نکردن تغییرات صفحه را رفرش کنید.
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#submit').click(function () {
                var add1q = $('#q-1').val();
                var add11 = $('#a-1-1').val();
                var add12 = $('#a-1-2').val();
                var add13 = $('#a-1-3').val();
                var add14 = $('#a-1-4').val();
                var ad1c = $('#ad-1-c').val();
                $.ajax({
                    type: "POST",
                    url: 'control.php',
                    data: "addedit1=1&add1g=" + add1q + "&add11=" + add11 + "&add12=" + add12 + "&add13=" + add13 + "&add14=" + add14 + "&ad1c=" + ad1c,
                    success: function (add1s) {
                        $('#add-edit-alert').show(500);
                        $('#add-edit-alert').delay(3000).fadeOut(500);
                        if (add1s == 1) {
                            $('#add-edit-alert').show(500);
                            $('#add-edit-alert').hide(2000);
                        }
                        if (add1s == 0) {
                            alert("مشکلی در ارسال داده ها پیش آمده است. ")
                        }
                    }
                });

            });
        });
    </script>
    <?php
}
if ($res[0]["type"]==2) {
    ?>
<div class="container rtl">
    <label>سوال: </label>
    <input type="text"id="q-2"class="form-control"value="<?php echo $res[0]["q"]; ?>">
    <br>
    <input type="submit" id="submit" value="ذخیره" class="btn btn-success">
    <br><br>
    <div class="alert alert-success" id="add-edit-alert" style="display: none;">
        تغییرات با موفقیت ذخیره شد.در صورت مشاهده نکردن تغییرات صفحه را رفرش کنید.
    </div>
</div>
    <script>
        $(document).ready(function () {
            $('#submit').click(function () {
                var q2 = $('#q-2').val();
                $.ajax({
                    type: "POST",
                    url: 'control.php',
                    data: "addedit2=1&q2=" + q2 ,
                    success: function (add1s) {
                        $('#add-edit-alert').show(500);
                        $('#add-edit-alert').delay(3000).fadeOut(500);
                        if (add1s == 1) {
                            $('#add-edit-alert').show(500);
                            $('#add-edit-alert').hide(2000);
                        }
                        if (add1s == 0) {
                            alert("مشکلی در ارسال داده ها پیش آمده است. ")
                        }
                    }
                });

            });
        });
    </script>

    <?php
}
?>

<footer class="fixed-bottom d-inline-block text-center">
    <hr class="text-secondary">
    <img src="../../data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 17px">
    <p class="text-secondary d-inline-block"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>