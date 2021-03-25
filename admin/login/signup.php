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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../../data/style/font/font.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../data/img/logo/آزمون%20آنلاین.jpg" title="آزمون آنلاین" />
    <title>آزمون آنلاین</title>
</head>
<style>
    /* Style the form */
    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }

    /* Style the input fields */
    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #4CAF50;
    }
    body{
        background-image: url("../../data/img/logo/index.jpg");
    }
</style>
<body class="text-right">


<form id="regForm" action="signup.php"method="post">

    <h1>عضویت: </h1>

    <!-- One "tab" for each step in the form: -->
    <div class="tab">نام و نام خانوادگی:
        <hr>
        <p><input placeholder="نام..." oninput="this.className = ''"name="name"></p>
        <p><input placeholder="نام خانوادگی..." oninput="this.className = ''"name="lname"></p>
    </div>

    <div class="tab">اطلاعات تماس:
        <hr>
        <p><input placeholder="E-mail..." oninput="this.className = ''"type="email"name="email"></p>
        <p><input placeholder="شماره تماس..." oninput="this.className = ''"type="tel"name="phone"></p>
    </div>


    <div class="tab">نام کاربری و رمز عبور:
        <hr>
        <p><input placeholder="نام کاربری..." oninput="this.className = ''"name="userna"></p>
        <p><input placeholder="رمز عبور..." oninput="this.className = ''"type="password"name="pass"></p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)"class="btn btn-outline-dark">قبلی</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)"class="btn btn-outline-dark">بعدی</button>
        </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <?php
    if (isset($_POST["name"])){
        $name=htmlspecialchars($_POST["name"]);
        $lname=htmlspecialchars($_POST["lname"]);
        $email=htmlspecialchars($_POST["email"]);
        $phone=htmlspecialchars($_POST["phone"]);
        $userna=htmlspecialchars($_POST["userna"]);
        $pass=htmlspecialchars($_POST["pass"]);

        $db1=$connection->prepare("select * from users where username='$userna'");
        $db1->execute();
        $exist_user=$db1->rowCount();

        if ($exist_user==0){
            $db2=$connection->prepare("INSERT INTO `users`(`id`, `username`, `password`, `phone`, `name`, `lname`, `info`) VALUES (null ,'$userna','$pass','$phone','$name','$lname','$email')");
            $db2->execute();
            session_start();
            $_SESSION["user"]=$userna;
            header("location: ../../user/user.php");
        }else{
            echo "<div class='alert alert-danger'>این نام کاربری از قبل وجود دارد</div>";
        }
    }
    ?>
</form>


<footer class="fixed-bottom d-inline-block text-center bg-light"style="font-size: 10px;margin: 2px;padding: 2px;">
    <img src="../../data/img/logo/ahhm-black.png" alt="logo"class="img-fluid d-inline-block"style="height: 17px;width: 16px">
    <p class="text-secondary d-inline-block"style="margin-bottom: 0px"><?php built(); ?></p><p class="d-inline text-secondary">   _    </p>
    <p class="text-secondary text-center d-inline-block"style="margin-bottom: 0px"> برای کارکرد بهتر سایت از مرورگر کروم یا فایر فاکس استفاده کنید.   </p>
</footer>
</body>
</html>
<script>
    $(document).ready(function () {

    });


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "ذخیره";
        } else {
            document.getElementById("nextBtn").innerHTML = "بعدی";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

</script>