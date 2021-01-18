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

if (isset($_POST['pro_name']) && !empty($_POST['pro_name']) && 
isset($_POST['pro_category']) &&!empty($_POST['pro_category']) &&
isset($_POST['pro_qty']) && !empty($_POST['pro_qty']) &&
isset($_POST['pro_price']) && !empty($_POST['pro_price']) && 
isset($_POST['pro_detail_less']) &&!empty($_POST['pro_detail_less']) &&
isset($_POST['pro_detail_title']) &&!empty($_POST['pro_detail_title']) &&
isset($_POST['pro_detail']) &&!empty($_POST['pro_detail']) &&
isset($_POST['pro_specification_title']) &&!empty($_POST['pro_specification_title']) &&
isset($_POST['pro_specification']) &&!empty($_POST['pro_specification'])) {


$pro_name = $_POST['pro_name'];
$pro_category = $_POST['pro_category'];
$pro_qty = $_POST['pro_qty'];
$pro_price = $_POST['pro_price'];
$pro_image = basename($_FILES["pro_image"]["name"]);
$pro_detail_less = $_POST['pro_detail_less'];
$pro_detail_title = $_POST['pro_detail_title'];
$pro_detail = $_POST['pro_detail'];
$pro_specification_title = $_POST['pro_specification_title'];
$pro_specification = $_POST['pro_specification'];



	} else
    exit("<h4 style='font-family: Khandevane' class='text-danger'>برخی از فیلد ها مقدار دهی نشده است</h4>");
	
}

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");
$link -> set_charset("utf8");

if (mysqli_connect_errno())
exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

if (isset($_GET['action'])) {

    $id = $_GET['id'];


	
    switch ($_GET['action']) {
        case 'EDIT':

            $query = "UPDATE product SET
             pro_name='$pro_name',
             pro_qty='$pro_qty',
             pro_price='$pro_price',
             pro_detail_less='$pro_detail_less',
             pro_image='$pro_image',
             pro_detail='$pro_detail',
             pro_specification='$pro_specification',
             pro_detail_title='$pro_detail_title',
             pro_specification_title='$pro_specification_title',
             pro_category='$pro_category'
                         
             WHERE pro_code='$id'";


            if (mysqli_query($link, $query) === true)
            echo("<h4 style='font-family: Khandevane' class='text-success'>محصول انتخاب شده با موفقيت ويرايش شد</h4>");
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ويرايش محصول</h4>");
            break;
			
        case 'DELETE':
			$query = "SELECT pro_image  FROM product
             WHERE pro_code='$id'";
			$result=mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			$pro_image=$row['pro_image'];
			
            $query = "DELETE  FROM product
             WHERE pro_code='$id'";

            if (mysqli_query($link, $query) === true){
                echo("<h4 style='font-family: Khandevane' class='text-success'>محصول انتخاب شده با موفقيت حذف شد</h4>");
				unlink("images/products/".$pro_image);
			}
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در حذف محصول</h4>");
            break;
			
    } //switch
    mysqli_close($link);
    exit();
			
} //if


$target_dir = "images/products/";
$target_file = $target_dir . basename($_FILES["pro_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


$check = getimagesize($_FILES["pro_image"]["tmp_name"]);
if ($check !== false) {
    echo("<h4 style='font-family: Khandevane' class='text-success'>پرونده انتخابی یک تصویر از نوع - " . $check["mime"] . " است  </h4><br>");
    $uploadOk = 1;
} else {
    echo("<h4 style='font-family: Khandevane' class='text-danger'>پرونده انتخاب شده یک تصویر نیست</h4><br>");
    $uploadOk = 0;
}


if (file_exists($target_file)) {
    echo("<h4 style='font-family: Khandevane' class='text-danger'>پرونده ای با همین نام در سرویس دهنده میزبان وجود دارد</h4><br>");
    $uploadOk = 0;
}

if ($_FILES["pro_image"]["size"] > 500000) {
    echo("<h4 style='font-family: Khandevane' class='text-danger'>اندازه پرونده انتخابی بیشتر از 500 کیلوبایت است</h4><br>");
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=
    "jpeg" && $imageFileType != "gif") {
        echo("<h4 style='font-family: Khandevane' class='text-danger'>فقط پسوندهای JPG, JPEG, PNG & GIF برای پرونده مجاز هستند</h4><br>");
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo("<h4 style='font-family: Khandevane' class='text-danger'>پرونده انتخاب شده به سرویس دهنده میزبان ارسال نشد</h4><br>");
} else {
    if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
        echo("<h4 style='font-family: Khandevane' class='text-success'>".
        "پرونده " . basename($_FILES["pro_image"]["name"]) ." با موفقیت به سرویس دهنده میزبان انتقال یافت </h4><br>");
    } else {
        echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ارسال پرونده به سرویس دهنده میزبان رخ داده است</h4><br>");
    }
}

if ($uploadOk == 1) {


    $query = "INSERT INTO product
    (pro_name,
     pro_qty,
     pro_category,
     pro_price,
     pro_image,
     pro_detail_less,
     pro_detail_title,
     pro_detail,
     pro_specification_title,
     pro_specification) VALUES
      ('$pro_name',
       '$pro_qty',
       '$pro_category',
       '$pro_price',
       '$pro_image',
       '$pro_detail_less',
       '$pro_detail_title',
       '$pro_detail',
       '$pro_specification_title',
       '$pro_specification')";

    if (mysqli_query($link, $query) === true)
    echo("<h4 style='font-family: Khandevane' class='text-success'>کالا با موفقیت به انبار اضافه شد</h4>");
    else
    echo("<h4 style='font-family: Khandevane' class='text-danger'> خطا در ثبت مشخصات کالا در انبار از سمت پایگاه داده</h4>");
} else
echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ثبت مشخصات کالا در انبار</h4>");

mysqli_close($link);

?>
                </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<br><br>