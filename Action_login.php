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

                        //بررسي خالي نبودن كادر متن نام كاربري و گذرواژه

                        if ((isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) &&
                            !empty($_POST['password']))) {

                            $username = $_POST['username']; // ذخيره نام كاربري
                            $password = $_POST['password'];  // ذخيره گذرواژه
                        } else
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>برخی از فیلد ها مقدار دهی نشده است</h4>");



                        $link = mysqli_connect("localhost", "root", "", "hirad" , "3308"); // اتصال به  پايگاه داده

                        if (mysqli_connect_errno())
                            exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

                        // پرس و جو بر اساس نام كاربري و گذرواژه
                        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                        $result = mysqli_query($link, $query);   //اجراي پرس و جو $query

                        $row = mysqli_fetch_array($result);   //ذخيره اطلاعات ركورد كاربر در آرايه $row

                        if ($row) {
                            $_SESSION["state_login"] = true;
                            $_SESSION["realname"] = $row['realname'];

                            $_SESSION["username"] = $row['username'];


                            if ($row["type"] == 0)
                                $_SESSION["user_type"] = "public";

                            elseif ($row["type"] == 1) {
                                $_SESSION["user_type"] = "admin";

                                ?>

                                <script type="text/javascript">
                                    location.replace("admin_products.php");
                                </script>

                                <?php
                            } // elseif پایان
                            echo ("<h4 style='font-family: Khandevane' class='text-center text-success'>{$row['realname']} به باشگاه هیراد خوش آمديد &nbsp;</h4>");
                        } else
                            echo ("<h4 style='font-family: Khandevane' class='text-center text-danger'>عضويت شما در فروشگاه انجام نشد</h4>");


                        mysqli_close($link);   // قطع اتصال پايگاه داده
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
