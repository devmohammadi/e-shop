<?php
include("Header.php");
include("MenuArticleProduct.php");

if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] == "admin")) {
?>
<script type="text/javascript">
location.replace("Index.php");	 // منتقل شود index.php به صفحه
</script>

<?php
} // if پایان
?>

<!-- Page Content -->
<div class="container text-right" dir="rtl">
    <div class="row">

        <div class="col-lg-3"><br><br>
            <div class="list-group">
                <a href="Admin_products.php" class="list-group-item">مدیریت محصولات</a>
                <a href="Admin_articles.php" class="list-group-item">مدیریت مقالات</a>
                <a href="#" class="list-group-item">مدیریت سفارشات</a>
                <a href="Admin_users.php" class="list-group-item">مدیریت کاربران</a>
                <a href="#" class="list-group-item">آپلود عکس</a>
                <a href="Admin_comment.php" class="list-group-item">نطرات کاربران</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <br><br>
             <!-- Core theme CSS (includes Bootstrap)-->
             <link href="css/bootstrap.css" rel="stylesheet" />
        <div class="container">


<?php


if (!(isset($_GET['action']) && $_GET['action']=='DELETE')){


if (isset($_POST['realname'])  && !empty($_POST['realname']) &&
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['repassword']) && !empty($_POST['repassword']) &&
    isset($_POST['email']) && !empty($_POST['email'])&&
    isset($_POST['typeUser']) && !empty($_POST['typeUser'])) {


$username = $_POST['username'];
$realname = $_POST['realname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
if($_POST['typeUser']== 'کاربر')
$type = 0;
if($_POST['typeUser']== 'مدیر')
$type = 1;



	} else{
        exit("<h4 style='font-family: Khandevane' class='text-danger'>برخی از فیلد ها مقدار دهی نشده است</h4>");
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    exit("<h4 style='font-family: Khandevane' class='text-center text-danger'>پست اكترونيك وارد شده صحيح نیست</h4>");


    if($repassword != $password )
    exit("<h4 style='font-family: Khandevane' class='text-danger'>رمز عبور با تکرار آن برابر نیست</h4>");
	
}

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");
$link -> set_charset("utf8");

if (mysqli_connect_errno())
exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

if (isset($_GET['action'])) {

    $id = $_GET['id'];


	
    switch ($_GET['action']) {
        case 'EDIT':

            $query = "UPDATE users SET
             username='$username',
             realname='$realname',
             email='$email',
             password='$password',
             type='$type'
                         
             WHERE username='$id'";


            if (mysqli_query($link, $query) === true)
            echo("<h4 style='font-family: Khandevane' class='text-success'>کاربرانتخاب شده با موفقيت ويرايش شد</h4>");
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ويرايش کاربر</h4>");
            break;
			
        case 'DELETE':
            $query = "DELETE  FROM users
             WHERE username='$id'";

            if (mysqli_query($link, $query) === true){
                echo("<h4 style='font-family: Khandevane' class='text-success'>کاربر انتخاب شده با موفقيت حذف شد</h4>");
			}
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در حذف کاربر</h4>");
            break;
			
    } //switch
    mysqli_close($link);
    exit();
			
} //if


    $query = "INSERT INTO users
    (username,
     realname,
     password,
     email,
     type) VALUES
      ('$username',
       '$realname',
       '$password',
       '$email',
       '$type')";

    if (mysqli_query($link, $query) === true)
    echo("<h4 style='font-family: Khandevane' class='text-success'>کاربر با موفقیت ثبت نام شد</h4>");
    else
    echo("<h4 style='font-family: Khandevane' class='text-danger'> خطا در ثبت مشخصات کاربر از سمت پایگاه داده</h4>");


mysqli_close($link);

?>
                </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<br><br>