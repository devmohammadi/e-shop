<?php
include("Header.php");
include("Menu.php");
include("SlideContactUs.php");


if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
    ?>
    <script type="text/javascript">
    location.replace("index.php");	 // منتقل شود index.php به صفحه
    </script>
    <?php
    } // if پایان
    
    $link = mysqli_connect("localhost", "root", "", "hirad" , "3308");
    
    if (mysqli_connect_errno())
    exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

    if (isset($_POST['subject']) && isset($_POST['email_auther']) && isset($_POST['realname']))
    $subject=$_POST['subject'];
    $email_auther=$_POST['email_auther'];
    $realname=$_POST['realname'];
    $state= 2;

    if (isset($_SESSION['username']))
        $username=$_SESSION['username'];

    
?>
    <!-- Heading Row -->
    <br><br>
    <div class="container" style="font-family: 'Khandevane';">
        <div class="card">
            <header><h1 class="text-justify m-2" style="font-family: 'Khandevane';">تماس با ما</h1></header>
        </div>

        <div class="container" style="font-family: 'Khandevane';">
            <div class="row my-5 text-right" style="line-height: 40px">

                <div class="container">
                    <?php
                    
                    $query = "INSERT INTO comments 
                    (username, realname , email_auther , state ,  body)
                    VALUES
                    ('$username','$realname','$email_auther',$state,'$subject')";


                    if (mysqli_query($link, $query) === true)
                    echo("<h4 style='font-family: Khandevane' class='text-success'>کاربر گرامی پیام شما با موفقیت دریافت شد</h4>");
                    else
                    echo("<h4 style='font-family: Khandevane' class='text-danger'> خطا در ارسال پیام</h4>");

                    mysqli_close($link);
                    
                    ?>
                </div>
            </div>
            <h1 class="text-right" style="font-family: 'Khandevane';">آدرس ما در گوگل</h1>
            <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d214969.34519040605!2d51.54694112154443!3d32.66221109363028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fbc35fe8c326799%3A0x7ab57816ef5837f5!2sIsfahan%2C%20Isfahan%20Province%2C%20Iran!5e0!3m2!1sen!2suk!4v1608585335859!5m2!1sen!2suk" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div><br><br><br><br>
        </div>
    </div>

<?php
include("Footer.php");
?>