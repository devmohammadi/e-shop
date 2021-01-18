<?php
include("Header.php");
include("MenuArticleProduct.php");

$link = mysqli_connect("localhost", "root", "", "hirad" , "3308" );
$link -> set_charset("utf8");

if (mysqli_connect_errno())
exit("<h4 style='font-family: Khandevane' class='text-danger'>خطاي با شرح زير رخ داده است :</h4>" . mysqli_connect_error());

$art_code=0;
if (isset($_GET['id']))
	 $art_code=$_GET['id'];

$query = "SELECT * FROM article WHERE art_code='$art_code '";            

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
                <h1 class="my-4" style="font-family: 'Khandevane'">مقالات مرتبط</h1>
                <div class="list-group">
                    <a href="Article.php?id=<?php echo($rowMenu['art_code']) ?>" class="list-group-item">حرکت شناسی</a>
                    <a href="Article.php?id=<?php echo($rowMenu['art_code']) ?>" class="list-group-item">هوازی</a>
                    <a href="Article.php?id=<?php echo($rowMenu['art_code']) ?>" class="list-group-item">فیتنس</a>
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
                
                    <img class="card-img-top img-fluid" src="images/articles/<?php echo ($row['art_image']) ?>" 
                    alt="<?php echo ($row['art_name']) ?>" title="<?php echo ($row['art_name']) ?>"
                         style="width: 900px; height: 350px;">
                    <div class="card-body text-justify">
                        <h3 class="card-title" style="color: red;font-family: 'Khandevane'"><?php echo ($row['art_name']) ?></h3>
                        <br>
                        <p class="card-text text-justify"><?php echo ($row['art_detail']) ?></p>
                        <br>
                        <div class="text-left">
                            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                            &nbsp;&nbsp;&nbsp; 4.0
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                </div>
                
                <!-- /.card -->
                <br><br>

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
    <!-- /.container -->


<?php
include("Footer.php");
?>