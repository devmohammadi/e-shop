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

$url = $username = $realname = $email = $type = $password = $repassword = "";

$btn_caption="افزودن کاربر جدید";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE username='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $username = $row['username'];
        $realname = $row['realname'];
        $email = $row['email'];
        $password = $row['password'];
        $repassword = $row['password'];
        $type = $row['type'];
        $url = "?id=$username&action=EDIT";
        $btn_caption="ويرايش کاربر";

    }
		
}

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
                    <form name="add_user" action="Action_admin_users.php<?php if (!empty($url)) echo($url); ?>"  method="POST" enctype="multipart/form-data">

                        <label for="fname">نام کاربری</label><span style="color: red;">*</span><br>
                        <input type="text" class="form-control" value="<?php echo ($username) ?>" name="username" placeholder="نام کاربری را وارد کنید"><br>


                        <label for="fname">نام کاربر</label><span style="color: red;">*</span><br>
                        <input type="text" class="form-control" value="<?php echo ($realname) ?>" name="realname" placeholder="نام کاربر را وارد کنید"><br>

                        <label for="fname">رمز عبور</label><span style="color: red;">*</span><br>
                        <input type="password" class="form-control" value="<?php echo ($password) ?>" name="password" placeholder="رمز عبور کاربر را وارد کنید"><br>

                        <label for="fname">تکرار رمز عبور</label><span style="color: red;">*</span><br>
                        <input type="password" class="form-control" value="<?php echo ($password) ?>" name="repassword" placeholder="تکرار رمز عبور کاربر را وارد کنید"><br>

                        <label for="fname">ایمیل</label><span style="color: red;">*</span><br>
                        <input type="email" class="form-control" value="<?php echo ($email) ?>" name="email" placeholder="ایمیل را وارد کنید"><br>


                        <?php if (!empty($url)) {?>
                        <label for="inlineFormCustomSelect">نوع کاربر</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="typeUser" value="<?php  echo $row['type'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option <?php  if ($row['type']=='1') {
                            echo  "selected";
                        } ?> value="مدیر">مدیر</option>
                            <option <?php  if ($row['type']=='0') {
                            echo  "selected";
                        } ?> value="کاربر">کاربر</option>
                        </select><br>
                        <?php
                        }else{
                        ?>
                        <label for="inlineFormCustomSelect">نوع کاربر</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="typeUser" value="<?php  echo $row['type'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option value="مدیر">مدیر</option>
                            <option value="کاربر">کاربر</option>
                        </select><br>
                        <?php
                        }
                        ?>

                        <br>
                        <div class="float-left"><br>
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="submit" value="<?php echo ($btn_caption) ?>" >
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="reset" value="جدید">
                        <br></div>
                    </form>
                </div><br><br><br><br><br><br>
        </div>
<?php

$query = "SELECT * FROM users";
$result = mysqli_query($link, $query);

?>

<br><br>
<div class="container">
<table class="table table-hover" style="width: 100%;" >
<tr>
    <td>نام کاربری</td>
    <td>نام کاربر</td>
    <td>ایمیل</td>
    <td>نوع کاربر</td>
	<td>ابزار مديريتي</td>
</tr>

<?php
while ($row = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo ($row['username']) ?></td>
	<td><?php echo ($row['realname']) ?></td>
	<td><?php echo ($row['email']) ?></td>
	<td>
    <?php
    if($row['type'] == 1)  echo("<span style='font-family: Khandevane' class='text-success'>مدیر</span>");
    if($row['type'] == 0) echo 'کاربر';
    ?>
    </td>
    <td>
     <b><a href="Action_admin_users.php?id=<?php echo ($row['username']) ?>&action=DELETE" style="text-decoration: none;">حذف</a></b>    
     &nbsp;|&nbsp;
     <b><a href="Admin_users.php?id=<?php echo ($row['username']) ?>&action=EDIT" style="text-decoration: none;">ويرايش</a></b>    
     </td>
</tr>
<?php
} //while
?>

</table>
</div>
</div>
   

    <!-- /.row -->
</div>
<!-- /.container -->
<br><br><br><br>