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


$url = $art_code = $art_name = $art_image = $art_detail = $art_star = $art_category = "";

$btn_caption="افزودن مقاله";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM article WHERE art_code='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $art_code = $row['art_code'];
        $art_name = $row['art_name'];
        $art_image = $row['art_image'];
        $art_detail = $row['art_detail'];
        $art_star = $row['art_star'];
        $art_category = $row['art_category'];
        $url = "?id=$art_code&action=EDIT";
        $btn_caption="ویرایش مقاله";

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
                    <form name="add_article" action="Action_admin_articles.php<?php if (!empty($url)) echo($url); ?>"  method="POST" enctype="multipart/form-data">

                        <label for="fname">نام مقاله</label><span style="color: red;">*</span><br>
                        <input type="text" class="form-control" value="<?php echo ($art_name) ?>" name="art_name" placeholder="نام مقاله را وارد کنید"><br>

                        <?php if (!empty($url)) {?>
                        <label for="inlineFormCustomSelect">دسته بندی مقاله</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="art_category" value="<?php  echo $row['art_category'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option <?php  if ($row['art_category']=='انگیزشی') {
                            echo  "selected";
                        } ?> value="انگیزشی">انگیزشی</option>
                            <option <?php  if ($row['art_category']=='چربی سوزی ') {
                            echo  "selected";
                        } ?> value="چربی سوزی">چربی سوزی</option>
                            <option <?php  if ($row['art_category']=='تغذیه') {
                            echo  "selected";
                        } ?> value="تغذیه">تغذیه</option>
                            <option <?php  if ($row['art_category']=='ورزش درخانه') {
                            echo  "selected";
                        } ?> value="ورزش درخانه">ورزش درخانه</option>

                        <option <?php  if ($row['art_category']=='فیتنس') {
                            echo  "selected";
                        } ?> value="فیتنس">فیتنس</option>
                        <option <?php  if ($row['art_category']=='هوازی') {
                            echo  "selected";
                        } ?> value="هوازی">هوازی</option>
                        <option <?php  if ($row['art_category']=='حرکت شناسی') {
                            echo  "selected";
                        } ?> value="حرکت شناسی">حرکت شناسی</option>
                        </select><br>
                        <?php
                        }else{
                        ?>
                        <label for="inlineFormCustomSelect">دسته بندی مقاله</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="art_category" value="<?php  echo $row['art_category'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option value="انگیزشی">انگیزشی</option>
                            <option value="چربی سوزی">چربی سوزی</option>
                            <option value="تغذیه">تغذیه</option>
                            <option value="ورزش درخانه">ورزش درخانه</option>
                            <option value="فیتنس">فیتنس</option>
                            <option value="هوازی">هوازی</option>
                            <option value="حرکت شناسی">حرکت شناسی</option>
                           
                        </select><br>
                        <?php
                        }
                        ?>
<br>
                        <div class="form-group">
                        <label for="exampleFormControlFile1">تصویر مقاله</label><span style="color: red;">*</span><br>
                        <input type="file" class="form-control-file" name="art_image" id="exampleFormControlFile1">
                        <?php if (!empty($art_image))
                        echo ("<img src='images/articles/$art_image' width='80' height='40' />"); ?>
                        </td>
                        <br>

                        <label for="fname">توضیحات</label><span style="color: red;">*</span><br>
                        <textarea class="form-control"  name="art_detail" rows="15" placeholder="توضیحات مقاله را وارد کنید." ><?php print ($art_detail) ?></textarea><br>

                        <div class="float-left"><br>
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="submit" value="<?php echo ($btn_caption) ?>" >
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="reset" value="جدید">
                        <br></div>
                    </form>
                </div>
        </div>
        <br><br><br><br>
<?php

$query = "SELECT * FROM article";
$result = mysqli_query($link, $query);

?>

<br><br>
<div class="container">
<table class="table table-hover" style="width: 100%;" >
<tr>
<td>کد مقاله</td>
	<td>نام مقاله</td>
	<td>تصوير مقاله</td>
	<td>ابزار مديريتي</td>
</tr>

<?php
while ($row = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo ($row['art_code']) ?></td>
	<td><?php echo ($row['art_name']) ?></td>
	<td><img src="images/articles/<?php echo ($row['art_image']) ?>" width="150px" height="50px" /></td>
	<td>
     <b><a href="Action_admin_articles.php?id=<?php echo ($row['art_code']) ?>&action=DELETE" style="text-decoration: none;">حذف</a></b>    
     &nbsp;|&nbsp;
     <b><a href="Admin_articles.php?id=<?php echo ($row['art_code']) ?>&action=EDIT" style="text-decoration: none;">ويرايش</a></b>    
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