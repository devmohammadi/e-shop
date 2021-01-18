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

$url = $pro_code = $pro_name = $pro_category = $pro_qty = $pro_price = $pro_image = $pro_detail_less = $pro_detail_title = $pro_detail =  $pro_specification_title = $pro_specification = "";

$btn_caption="افزودن كالا";
if (isset($_GET['action']) && $_GET['action'] == 'EDIT') {
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE pro_code='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($result)) {
        $pro_code = $row['pro_code'];
        $pro_name = $row['pro_name'];
        $pro_category = $row['pro_category'];
        $pro_qty = $row['pro_qty'];
        $pro_price = $row['pro_price'];
        $pro_image = $row['pro_image'];
        $pro_detail_less = $row['pro_detail_less'];
        $pro_detail_title = $row['pro_detail_title'];
        $pro_detail = $row['pro_detail'];
        $pro_specification_title = $row['pro_specification_title'];
        $pro_specification = $row['pro_specification'];
        $url = "?id=$pro_code&action=EDIT";
        $btn_caption="ويرايش كالا";

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
                    <form name="add_product" action="Action_admin_products.php<?php if (!empty($url)) echo($url); ?>"  method="POST" enctype="multipart/form-data">

                        <label for="fname">نام کالا</label><span style="color: red;">*</span><br>
                        <input type="text" class="form-control" value="<?php echo ($pro_name) ?>" name="pro_name" placeholder="نام کالا را وارد کنید"><br>

                        <?php if (!empty($url)) {?>
                        <label for="inlineFormCustomSelect">دسته بندی کالا</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="pro_category" value="<?php  echo $row['pro_category'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option <?php  if ($row['pro_category']=='مکمل') {
                            echo  "selected";
                        } ?> value="مکمل">مکمل</option>
                            <option <?php  if ($row['pro_category']=='وسایل و تجهیزات ورزشی') {
                            echo  "selected";
                        } ?> value="وسایل و تجهیزات ورزشی">وسایل و تجهیزات ورزشی</option>
                            <option <?php  if ($row['pro_category']=='لباس ورزشی') {
                            echo  "selected";
                        } ?> value="لباس ورزشی">لباس ورزشی</option>
                            <option <?php  if ($row['pro_category']=='کتونی') {
                            echo  "selected";
                        } ?> value="کتونی">کتونی</option>
                        </select><br>
                        <?php
                        }else{
                        ?>
                        <label for="inlineFormCustomSelect">دسته بندی کالا</label><span style="color: red;">*</span><br>
                        <select class="custom-select" id="inlineFormCustomSelect" name="pro_category" value="<?php  echo $row['pro_category'] ?>">
                            <option selected>انتخاب کنید...</option>
                            <option value="مکمل">مکمل</option>
                            <option value="وسایل و تجهیزات ورزشی">وسایل و تجهیزات ورزشی</option>
                            <option value="لباس ورزشی">لباس ورزشی</option>
                            <option value="کتونی">کتونی</option>
                        </select><br>
                        <?php
                        }
                        ?>

                        <br><label for="fname">موجودی کالا</label><span style="color: red;">*</span><br>
                        <input type="number" class="form-control" value="<?php echo ($pro_qty) ?>" name="pro_qty" placeholder="موجودی کالا را وارد کنید"><br>

                        <label for="fname">قیمت کالا ( تومان ) </label><span style="color: red;">*</span><br>
                        <input type="number" class="form-control" value="<?php echo ($pro_price) ?>" name="pro_price" placeholder="قیمت کالا را وارد کنید"><br>

                        <div class="form-group">
                        <label for="exampleFormControlFile1">تصویر کالا</label><span style="color: red;">*</span><br>
                        <input type="file" class="form-control-file" name="pro_image" id="exampleFormControlFile1">
                        <?php if (!empty($pro_image))
                        echo ("<img src='images/products/$pro_image' width='80' height='40' />"); ?>
                        </td>
                        <br>

                        <label for="fname">توضیح کوتاه کالا</label><span style="color: red;">*</span><br>
                        <textarea class="form-control" name="pro_detail_less" rows="3" placeholder="توضیحات کوتاهی را برای محصول وارد کنید" ><?php print ($pro_detail_less) ?></textarea><br>

                        <label for="fname">عناوین توضیحات</label><span style="color: red;">*</span><br>
                        <textarea class="form-control" name="pro_detail_title" rows="3" placeholder="عناوین توضیحات را وارد کنید ، برای اضافه کردن چندین عنوان آنها را با + از هم جدا کنید" ><?php print ($pro_detail_title) ?></textarea><br>

                        <label for="fname">توضیحات</label><span style="color: red;">*</span><br>
                        <textarea class="form-control"  name="pro_detail" rows="7" placeholder="توضیحات را وارد کنید ، برای اضافه کردن چندین عنوان آنها را با + از هم جدا کنید" ><?php print ($pro_detail) ?></textarea><br>

                        <label for="fname">عناوین مشخصات کالا</label><span style="color: red;">*</span><br>
                        <textarea class="form-control"  name="pro_specification_title" rows="3" placeholder="عناوین مشخصات کالا را وارد کنید ، برای اضافه کردن چندین عنوان آنها را با + از هم جدا کنید" ><?php echo ($pro_specification_title) ?></textarea><br>

                        <label for="fname">مشخصات کالا</label><span style="color: red;">*</span><br>
                        <textarea class="form-control" name="pro_specification" rows="7" placeholder="مشخصات کالا را وارد کنید ، برای اضافه کردن چندین عنوان آنها را با + از هم جدا کنید" ><?php echo ($pro_specification) ?></textarea><br>

                        <div class="float-left"><br>
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="submit" value="<?php echo ($btn_caption) ?>" >
                        <input style="font-family: 'Khandevane';" class="btn btn-success" type="reset" value="جدید">
                        <br></div>
                    </form>
                </div>
        </div>
        <br><br><br><br>
<?php

$query = "SELECT * FROM product";
$result = mysqli_query($link, $query);

?>

<br><br>
<div class="container">
<table class="table table-hover" style="width: 100%;" >
<tr>
<td>کد كالا</td>
	<td>نام كالا</td>
	<td>موجودي كالا</td>
	<td>قيمت كالا</td>
	<td>تصوير كالا</td>
	<td>ابزار مديريتي</td>
</tr>

<?php
while ($row = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo ($row['pro_code']) ?></td>
	<td><?php echo ($row['pro_name']) ?></td>
	<td><?php echo ($row['pro_qty']) ?></td>
	<td><?php echo ($row['pro_price']) ?>&nbsp; تومان</td>
	<td><img src="images/products/<?php echo ($row['pro_image']) ?>" width="150px" height="50px" /></td>
	<td>
     <b><a href="action_admin_products.php?id=<?php echo ($row['pro_code']) ?>&action=DELETE" style="text-decoration: none;">حذف</a></b>    
     &nbsp;|&nbsp;
     <b><a href="admin_products.php?id=<?php echo ($row['pro_code']) ?>&action=EDIT" style="text-decoration: none;">ويرايش</a></b>    
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