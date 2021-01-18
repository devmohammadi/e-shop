<?php
include("Header.php");
include("MenuLogin.php");
if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
    ?>
    <script type="text/javascript">
    location.replace("Index.php");	 // منتقل شود index.php به صفحه
    </script>
    <?php
    } // if پایان
?>
<!--Custom styles-->
<link rel="stylesheet" type="text/css" href="css/loginStyle.css">


<!-- Masthead-->
<header class="masthead" id="loginRegister">
    <div class="container h-100">
        <div class="container" >
            <div class="d-flex justify-content-center h-100">
                <div class="card" >
                    <div class="card-header">
                        <h3 style="font-family: Khandevane" >ورود به سایت</h3>
                        <div class="d-flex justify-content-end social_icon">
                            <span><i class="fab fa-facebook-square"></i></span>
                            <span><i class="fab fa-google-plus-square"></i></span>
                            <span><i class="fab fa-twitter-square"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form name="login" action="Action_login.php" method="post">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="نام کاربری" name="username">

                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="رمز عبور" name="password">
                            </div>
                            <div class="form-group">
                                <br>
                                <input style="font-family: Khandevane" type="submit" value="ورود" class="btn btn-block login_btn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            حساب کاربری ندارید ؟ &nbsp;<a href="Register.php">ثبت نام </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#">رمز عبور را فراموش کردم</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

