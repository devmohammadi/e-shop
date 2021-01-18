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

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");
$link -> set_charset("utf8");

if (mysqli_connect_errno())
exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

if (isset($_GET['action'])) {

    $id = $_GET['id'];


	
    switch ($_GET['action']) {
        case 'EDIT':
	
        case 'DELETE':

            $query = "DELETE  FROM comments
             WHERE id='$id'";

            if (mysqli_query($link, $query) === true){
                echo("<h4 style='font-family: Khandevane' class='text-success'>پیام انتخاب شده با موفقيت حذف شد</h4>");
			}
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در حذف پیام</h4>");
            break;
			
    } //switch
    mysqli_close($link);
    exit();
			
} //if


?>
                </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<br><br>