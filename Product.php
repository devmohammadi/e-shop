<?php
include("Header.php");
include("MenuArticleProduct.php");

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308" );
$link -> set_charset("utf8");
if (mysqli_connect_errno())
exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

$pro_code=0;
if (isset($_GET['id']))
	 $pro_code=$_GET['id'];

$query = "SELECT * FROM product WHERE pro_code='$pro_code '";            

$result = mysqli_query($link, $query);            //  اجراي پرس و جو

?>

<!-- Page Content -->
<div class="container text-right">

    <div class="row">

        <?php
            $resultMenu = mysqli_query($link, $query);  
            if ($rowMenu = mysqli_fetch_array($resultMenu)) {
        ?>
        <div class="col-lg-3">
            <h1 class="my-4" style="font-family: Khandevane">محصولات مرتبط</h1>
            <div class="list-group">
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">مبل ماساژ</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">دستگاه بدنسازی چندکاره</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">استیل فلکس</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">بادی سولید</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">وزن آزاد</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">نیمکت</a>
                <a href="Product.php?id=<?php echo($rowMenu['pro_code']) ?>" class="list-group-item">دمبل</a>
            </div>
        </div>
        <?php
            }
        ?>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="card mt-4">

            <?php
                if ($row = mysqli_fetch_array($result)) {
            ?> 

                <img class="card-img-top img-fluid" style="height: 350px;width: 900px"
                     src="images/products/<?php echo ($row['pro_image']) ?>"
                     alt="<?php echo ($row['pro_name']) ?>" title="<?php echo ($row['pro_name']) ?>">
                <div class="card-body">
                    <h3 class="card-title text-primary" style="line-height: 40px;font-family: Khandevane">
                    <?php echo ($row['pro_name']) ?></h3>
                    <h4 class="text-success" style="line-height: 40px;font-family: Khandevane">
                    <?php echo ($row['pro_price']) ?> تومان
                    </h4>
                    <h5 style="font-family: Khandevane">
                        موجودی : <span style="color: red">  <?php echo ($row['pro_qty']) ?> عدد</span>
                    </h5>
                    <p class="card-text text-justify">
                    <?php echo ($row['pro_detail_less']) ?>
                    </p>
                    <div class="text-left">
                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                        &nbsp;&nbsp;&nbsp; 4.0
                    </div>

                </div>
            </div>
            <!-- /.card -->

            <?php
            $pro_detail_title = $row['pro_detail_title'];
            $array_detail_title = explode ('+', $pro_detail_title); 

            $pro_detail = $row['pro_detail'];
            $array_detail= explode ('+', $pro_detail); 

            ?>

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    توضیحات
                </div>
                <div class="card-body">
                <?php
                    for ($x = 0; $x < count($array_detail) ; $x++) {
                        ?>
                    <p><?php echo("$array_detail_title[$x]") ?></p>
                    <small class="text-muted">
                    <?php  echo("$array_detail[$x]") ?>
                    </small>
                    <hr>
                <?php
                    }
                ?>
                </div>
            </div>
            <!-- /.card -->


            <?php
            $pro_specification_title = $row['pro_specification_title'];
            $array_specification_title = explode ('+', $pro_specification_title); 

            $pro_specification = $row['pro_specification'];
            $array_specification= explode ('+', $pro_specification); 

            ?>

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    مشخصات
                </div>
                <div class="card-body">
                <?php
                    for ($x = 0; $x < count($array_specification) ; $x++) {
                        ?>
                    <p><?php echo("$array_specification_title[$x]") ?></p>
                    <small class="text-muted">
                    <?php  echo("$array_specification[$x]") ?>
                    </small>
                    <hr>
                <?php
                    }
                ?>
                </div>

                <?php
                    }
                ?>

            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->

<?php
include("Footer.php");
?>

