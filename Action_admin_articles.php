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

if (isset($_POST['art_name']) && !empty($_POST['art_name']) && 
isset($_POST['art_category']) &&!empty($_POST['art_category']) &&
isset($_POST['art_detail']) &&!empty($_POST['art_detail'])) {


$art_name = $_POST['art_name'];
$art_category = $_POST['art_category'];
$art_image = basename($_FILES["art_image"]["name"]);
$art_detail = $_POST['art_detail'];



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

            $query = "UPDATE article SET
            art_name='$art_name',
            art_image='$art_image',
            art_detail='$art_detail',
            art_category='$art_category'
                         
             WHERE art_code='$id'";


            if (mysqli_query($link, $query) === true)
            echo("<h4 style='font-family: Khandevane' class='text-success'>مقاله انتخاب شده با موفقيت ويرايش شد</h4>");
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ويرايش مقاله</h4>");
            break;
			
        case 'DELETE':
			$query = "SELECT art_image  FROM article
             WHERE art_code='$id'";
			$result=mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			$art_image=$row['art_image'];
			
            $query = "DELETE  FROM article
             WHERE art_code='$id'";

            if (mysqli_query($link, $query) === true){
                echo("<h4 style='font-family: Khandevane' class='text-success'>محصول انتخاب شده با موفقيت حذف شد</h4>");
				unlink("images/articles/".$art_image);
			}
            else
            echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در حذف مقاله</h4>");
            break;
			
    } //switch
    mysqli_close($link);
    exit();
			
} //if


$target_dir = "images/articles/";
$target_file = $target_dir . basename($_FILES["art_image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


$check = getimagesize($_FILES["art_image"]["tmp_name"]);
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

if ($_FILES["art_image"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["art_image"]["tmp_name"], $target_file)) {
        echo("<h4 style='font-family: Khandevane' class='text-success'>".
        "پرونده " . basename($_FILES["art_image"]["name"]) ." با موفقیت به سرویس دهنده میزبان انتقال یافت </h4><br>");
    } else {
        echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ارسال پرونده به سرویس دهنده میزبان رخ داده است</h4><br>");
    }
}

if ($uploadOk == 1) {

    $query = "INSERT INTO article
    (art_name,
     art_category,
     art_image,
     art_star,
     art_detail) VALUES
      ('$art_name',
       '$art_category',
       '$art_image',
       '0',
       '$art_detail')";

    if (mysqli_query($link, $query) === true)
    echo("<h4 style='font-family: Khandevane' class='text-success'>مقاله با موفقیت اضافه شد</h4>");
    else
    echo("<h4 style='font-family: Khandevane' class='text-danger'> خطا در ثبت مشخصات مقاله از سمت پایگاه داده</h4>");
} else
echo("<h4 style='font-family: Khandevane' class='text-danger'>خطا در ثبت مشخصات مقاله</h4>");

mysqli_close($link);

?>
                </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<br><br>