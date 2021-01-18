<?php
include("Header.php");
include("MenuArticleProduct.php");

if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] ==
    "admin")) {
?>
<script type="text/javascript">
location.replace("Index.php");	 // منتقل شود index.php به صفحه
</script>
<?php
} // if پایان

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");  // اتصال به پايگاه داده shop_db
$link -> set_charset("utf8");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

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
<table class="table table-hover" style="width: 100%;" >
<tr>
    <td>نام نویسنده</td>
    <td>ایمیل</td>
    <td>پیام کاربر</td>
	<td>ابزار مديريتي</td>
</tr>

<?php

$query = "SELECT * FROM comments";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo ($row['realname']) ?></td>
	<td><?php echo ($row['email_auther']) ?></td>
	<td><?php echo ($row['body']) ?></td>
    <td>
     <b><a href="Action_admin_comment.php?id=<?php echo ($row['id']) ?>&action=DELETE" style="text-decoration: none;">حذف</a></b>      
     </td>
</tr>
<?php
} //while
?>

</table>
</div><br><br><br><br><br><br>
</div>
<br><br>

</div>  
<!-- /.row -->
</div>
<!-- /.container -->
<br><br><br><br>