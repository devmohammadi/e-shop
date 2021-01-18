<?php
include("Header.php");
include("MenuRegister.php");
?>

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
    <!-- Masthead-->
    <header class="masthead" id="loginRegister">
        <div class="container h-100" >
            <div class="container">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="font-family: Khandevane" class="text-center">پیام کاربر</h3>
                        </div>
                        <div class="card-body">
                        <?php
                        if (isset($_POST['realname'])  && !empty($_POST['realname']) &&
                            isset($_POST['username']) && !empty($_POST['username']) &&
                            isset($_POST['password']) && !empty($_POST['password']) &&
                            isset($_POST['repassword']) && !empty($_POST['repassword']) &&
                            isset($_POST['email']) && !empty($_POST['email'])) {

                            $realname = $_POST['realname'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $repassword = $_POST['repassword'];
                            $email = $_POST['email'];
                        } else
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>برخی از فیلد ها مقدار دهی نشده است</h4>");


                        if ($password != $repassword)
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>كلمه عبور و تكرار آن مشابه نيست</h4>");


                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>پست اكترونيك وارد شده صحيح نیست</h4>");

                        $link = mysqli_connect("localhost", "root", "", "hirad" , "3308");

                        if (mysqli_connect_errno())
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());
                        $query = "INSERT INTO users (realname,username,password,email,type) VALUES ('$realname','$username','$password','$email','0')";

                        if (mysqli_query($link, $query) === true)
                        echo ("<h4 style='font-family: Khandevane' class='text-center text-success'>".$realname ." ثبت نام شما انجام شد &nbsp;</h4>");
                        else
                            echo ("<h4 style='font-family: Khandevane' class='text-center text-danger'>عضويت شما در فروشگاه انجام نشد</h4>");

                        mysqli_close($link);

                        ?>

                            <div class="card-footer">
                                <div class="d-flex justify-content-center links">
                                     &nbsp;<a href="Index.php">ورود به صفحه اصلی سایت </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>
