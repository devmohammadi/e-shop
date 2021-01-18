<?php
include("Header.php");
include("MenuArticleProduct.php");

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");

$link -> set_charset("utf8");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "SELECT * FROM product LIMIT 9";             // پرس و جوي نمايش همه محصولات فروشگاه 


$result = mysqli_query($link, $query);            //  اجراي پرس و جو 
 

?>

<!-- Page Content -->
<div class="container text-right" dir="rtl">
    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">محصولات</h1>
            <div class="list-group">
                <a href="Product.php" class="list-group-item">مکمل</a>
                <a href="Product.php" class="list-group-item">وسایل و تجهیزات ورزشی</a>
                <a href="Product.php" class="list-group-item">لباس ورزشی</a>
                <a href="Product.php" class="list-group-item">کتونی</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" style="height: 350px;width: 900px" src="assets/img/product/slider/slider1.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" style="height: 350px;width: 900px" src="assets/img/product/slider/slider2.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" style="height: 350px;width: 900px" src="assets/img/product/slider/slider3.png" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">
            <?php
$counter = 0;
while ($row = mysqli_fetch_array($result)) {
$counter++;
?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="Product.php?id=<?php echo ($row['pro_code']) ?>"><img class="card-img-top h-100 w-100" src="images/products/<?php echo ($row['pro_image']) ?>" alt="<?php echo ($row['pro_name']) ?>" title="<?php echo ($row['pro_name']) ?>"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="Product.php?id=<?php echo ($row['pro_code']) ?>"><?php echo ($row['pro_name']) ?></a>
                            </h4>
                            <h5> <span style="color:red;"><?php echo ($row['pro_price']) ?></span> تومان</h5>
                            <p class="card-text text-justify">
                            <span style="color: #585252">
                                 <?php echo (substr($row['pro_detail'],0,285)) ?> ...
                                 </span>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="row text-justify" dir="rtl">
                                <div class="col-md-6 " dir="rtl">
                                    <div class="text-right" dir="rtl">
                                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="Product.php?id=<?php echo ($row['pro_code']) ?>"  class="btn btn-primary btn-sm" style="font-family: 'Khandevane';">مشاهده وخرید</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
    if ($counter % 3 == 0)
        echo ("</div><div class='row'>");
} // while

if ($counter % 3 != 0)
    echo ("</div>");
    ?>

</div>
            <!-- /.row -->
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6 flex-fill justify-content-center"></div>
        <div class="col-md-6 flex-fill justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="Products.php" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="Products.php">1</a></li>
                    <li class="page-item"><a class="page-link" href="Products.php">2</a></li>
                    <li class="page-item"><a class="page-link" href="Products.php">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="Products.php" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- /.container -->


<?php
include("Footer.php");
?>
