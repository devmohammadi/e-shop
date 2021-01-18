<?php
include("Header.php");
include("MenuRegister.php");
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
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3 style="font-family: Khandevane">ثبت نام در سایت</h3>
                        <div class="d-flex justify-content-end social_icon">
                            <span><i class="fab fa-facebook-square"></i></span>
                            <span><i class="fab fa-google-plus-square"></i></span>
                            <span><i class="fab fa-twitter-square"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form name="register" action="Action_register.php" method="post">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="ایمیل" name="email">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="نام کاربری" name="username">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="نام" name="realname">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="رمز عبور" name="password">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="تکرار رمز عبور"
                                       name="repassword">
                            </div>

                            <div class="form-group">
                                <input style="font-family: Khandevane" type="submit" value="ثبت نام"
                                       class="btn btn-block login_btn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            قبلا ثبت نام کرده اید ؟ &nbsp;<a href="Login.php">ورود </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
