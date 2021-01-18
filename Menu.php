<body id="page-top" dir="rtl">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 " id="mainNav">
        <div class="container">
            <img src="assets/img/favicon.ico" style="width: 30px; height: 30px;">
            <a class="navbar-brand js-scroll-trigger" href="#page-top" style="font-family: 'Khandevane';">باشگاه ورزشی هیراد</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Index.php" style="font-family: 'Khandevane';">خانه</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Articles.php" style="font-family: 'Khandevane';">مقالات</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Products.php" style="font-family: 'Khandevane';">محصولات</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="ContactUs.php" style="font-family: 'Khandevane';">تماس با ما</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="AboutUs.php" style="font-family: 'Khandevane';"> درباره ما</a></li>

                    <?php
                    if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
                        "admin")) {
                    ?>
                    <script type="text/javascript">
                     <li class="nav-item"><a class="nav-link js-scroll-trigger" href="MyBlog.php" style="font-family: 'Khandevane';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;وبلاگ من</a></li>
                    </script>
                    <?php
                    } // if پایان
                    else{
                        ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Admin_products.php" style="font-family: 'Khandevane';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;مدیریت سایت</a></li>
                    <?php
                    }
                    ?>

                </ul>

                <?php
                        if (isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true) 
                         {
                    ?>
                    <a class="nav-link js-scroll-trigger btn btn-danger btn-sm" href="Logout.php" style="font-family: 'Khandevane';">خروج</a>
                    <?php
                         } // if  پایان
                        else
                         { 
                    ?>
                    <a class="nav-link js-scroll-trigger btn btn-light btn-sm" href="Login.php" style="font-family: 'Khandevane';">ورود</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="nav-link js-scroll-trigger btn btn-light btn-sm" href="Register.php" style="font-family: 'Khandevane';"> ثبت نام</a>
                    <?php
                         }  //else پایان 
                    ?>
                     
            </div>
        </div>
    </nav>