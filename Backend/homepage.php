<?php

    require_once('config/db.php');
    require_once('config/config.php');
    $search = "";
    $title = "All Products";
    $file = 'images/';
    if(isset($_REQUEST['s'])){
        $search = mysqli_real_escape_string($conn,$_REQUEST['s']);
        $title = $search;
    }
 
    $query = "SELECT id,images,shortDis,rating,review,manufacturer,thumbnail,price FROM product_details WHERE category LIKE '%" . $search . "%'";
    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQL_ASSOC);
    $json=json_encode($products,true);

    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/Font-Awesome/all.min.css">
    <title>Home</title>
</head>
<body>
    <!-- Navbar -->
    <?php include('include/navbar.php'); ?>

    <!-- Header Showcase -->
    <header id="showcase">
        <div class="slider">
            <div class="slide current"></div>
            <div class="slide"></div>
            <div class="slide"></div>
            <div class="slide"></div>
        </div>
        <div class="content-wrap">
            <h1>You are Amazing</h1>
            <p>And we have amazing products for you !</p>    
            <a href="<?php echo ROOT_URL . 'categorypage.php' ?>" class="btn">Explore</a>
        </div>  
    </header>

    <!-- Main Area -->
    <main id="main">

        <!-- Top Products -->
        <section class="top-products">
            <div class="item item-1">
                <div class="content">
                    <h2>Cloths and Garments</h2>
                    <p>Imagine the next level of Fashion.</p>
                    <a href="<?php echo ROOT_URL . 'categorypage.php?s=Cloths and Garments' ?>" class="btn">Shop Now</a>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section id="categories-main">
            <div class="categories">
                <?php for($i=0;$i<4;$i++):?>
                    <div class="catg-1">
                        <figure class="item-card">
                            <a href="<?php echo ROOT_URL . 'categorypage.php?s=Cameras' ?>">
                                <img src="https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                <figcaption>Cameras</figcaption>
                            </a>   
                        </figure>
                        <figure class="item-card">
                            <a href="<?php echo ROOT_URL . 'categorypage.php?s=Laptops' ?>">
                                <img src="https://images.pexels.com/photos/129208/pexels-photo-129208.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                <figcaption>Laptops</figcaption>
                            </a>
                        </figure>  
                        <figure class="item-card">
                            <a href="<?php echo ROOT_URL . 'categorypage.php?s=Phones' ?>">
                                <img src="https://images.pexels.com/photos/47261/pexels-photo-47261.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                <figcaption>Phones</figcaption>
                            </a>
                        </figure>  
                        <figure class="item-card">
                            <a href="<?php echo ROOT_URL . 'categorypage.php?s=Tablets' ?>">
                                <img src="https://images.pexels.com/photos/2351844/pexels-photo-2351844.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                <figcaption>Tablets</figcaption>
                            </a>
                        </figure>  
                    </div>
                <?php endfor; ?>
            </div>    
        </section>

        <!-- Top Products -->
        <section class="top-products">
            <div class="item item-2">
                <div class="content">
                    <h2>Electronics</h2>
                    <p>A magical and revolutionary device at an unbelievable price.</p>
                    <a href="<?php echo ROOT_URL . 'categorypage.php?s=Electronics' ?>" class="btn">Shop Now</a>
                </div>
            </div> 
        </section>

        <section id="parallax-area">
            <div class="grid-content">
                <?php for($i=1;$i<=5;$i=$i+2):?>
                    <div class="<?php echo 'box-' . intval($i) ?>"></div>
                    <div class="<?php echo 'box-' . intval($i+1) ?>">
                    <div class="content-wrap">
                        <h2>Product1</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic vero ullam a nihil reiciendis totam voluptatem nemo dolorem blanditiis at!</p>
                        <a href="<?php echo ROOT_URL . 'categorypage.php?s=Electronics' ?>" class="btn">Shop Now</a>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include('include/footer.php'); ?>

    <script src="js/homepage.js"></script>
</body>
</html>