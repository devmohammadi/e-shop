<?php
include("Header.php");
include("Menu.php");
include("Slider.php");



$link = mysqli_connect("localhost", "root", "", "hirad" , "3308");

$link -> set_charset("utf8");

if (mysqli_connect_errno())
    exit("خطاي با شرح زير رخ داده است :" . mysqli_connect_error());

$query = "SELECT * FROM product LIMIT 9";             // پرس و جوي نمايش همه محصولات فروشگاه 
$query1 = "SELECT * FROM article LIMIT 3";

$result = mysqli_query($link, $query);            //  اجراي پرس و جو 
$result1 = mysqli_query($link, $query1); 

?> 
    <!-- Heading Row -->
    <br><br>
    <div class="container" style="font-family: 'Khandevane';" id="article">

        <div class="card">
            <header><h1 class="text-justify m-2" style="font-family: 'Khandevane';">مقالات</h1></header>
        </div><br>

        <div class="row align-items-center my-5">
            <?php
            $counterr = 0;
            while ($row1 = mysqli_fetch_array($result1)) {
            $counterr++;
            ?>
            <div class="col-lg-7">
                <img class="img-fluid rounded mb-4 mb-lg-0" style="width: 900px; height: 400px;" src="images/articles/<?php echo ($row1['art_image']) ?>" alt="<?php echo ($row1['art_name']) ?>" title="<?php echo ($row1['art_name']) ?>">
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-5">
                <h1 class="font-weight-light text-justify text-right" style="font-family: 'Khandevane';"><?php echo ($row1['art_name']) ?></h1>
                <p class="text-justify text-right">
                <?php echo (substr($row1['art_detail'],0,475)) ?>
                <?php if($counterr % 2 != 0){?> 
                ...
                <?php
                    }
                ?>
                </p>
                <a class="btn btn-primary text-justify text-right" href="article.php?id=<?php echo ($row1['art_code']) ?>" style="font-family: 'Khandevane';">مشاهده </a>
            </div>
            <!-- /.col-md-4 -->

        <?php
    if ($counterr % 1 == 0 && $counterr % 2 == 0)
        echo ("</div><div class='row align-items-center my-5'>");
        else{
            echo ("</div><div class='row align-items-center my-5 text-right' dir='ltr'>");
        }
        
} // while

if ($counterr % 1 != 0)
    echo ("</div>");

    ?>



    <br><br>
    <div class="container" id="product" dir="rtl">
        <div class="card">
            <header>
            <header><h1 class="text-justify m-2" style="font-family: 'Khandevane';">محصولات</h1></header>
            </header>
        </div>
        <br>
       
       
<!-- Content Row -->
 <!-- Content Row -->
<div class="row">       
<?php
$counter = 0;
while ($row = mysqli_fetch_array($result)) {
$counter++;
?>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card h-100">
                        <img class="card-img-top h-50" src="images/products/<?php echo ($row['pro_image']) ?>" alt="<?php echo ($row['pro_name']) ?>" title="<?php echo ($row['pro_name']) ?>">
                        <div class="card-body">
                            <h2 class="card-title text-primary text-justify" style="font-family: 'Khandevane';"><?php echo ($row['pro_name']) ?></h2>
                            <h5 class="text-justify">
                                <span style="font-family: 'Khandevane';">
                                <span style="color:red;"><?php echo ($row['pro_price']) ?></span> تومان
                                </span>
                            </h5>
                            <p class="card-text text-justify">
                                 <span style="color: #585252">
                                 <?php echo (substr($row['pro_detail'],0,250)) ?> ...
                                 </span>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="Product.php?id=<?php echo ($row['pro_code']) ?>" class="btn btn-primary btn-sm" style="font-family: 'Khandevane';">مشاهده وخرید</a>
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

        </div></div></div></div>

<?php
include("Footer.php");
?>