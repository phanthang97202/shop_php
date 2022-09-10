<?php
    include_once(__DIR__.'./component/header.php');
    include_once(__DIR__.'./component/menu.php');
    include_once(__DIR__.'./component/welcome.php');
    // var_dump($_SESSION['user']);
?>
        
      
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    body {
        font-family: "Poppins", sans-serif;
        color: #444444;
    }

    a,
    a:hover {
        text-decoration: none;
        color: inherit;
    }

    .section-products {
        padding: 80px 0 54px;
    }

    .section-products .header {
        margin-bottom: 50px;
    }

    .section-products .header h3 {
        font-size: 1rem;
        color: #fe302f;
        font-weight: 500;
    }

    .section-products .header h2 {
        font-size: 2.2rem;
        font-weight: 400;
        color: #444444; 
    }

    .section-products .single-product {
        margin-bottom: 26px;
    }

    .section-products .single-product .part-1 {
        position: relative;
        height: 290px;
        max-height: 290px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .section-products .single-product .part-1::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: all 0.3s;
    }

    .section-products .single-product:hover .part-1::before {
            transform: scale(1.2,1.2) rotate(5deg);
    }

    .section-products #product-1 .part-1::before {
        /* background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center; */
        background-size: cover;
            transition: all 0.3s;
    }

    .section-products #product-2 .part-1::before {
        /* background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center; */
        background-size: cover;
    }

    .section-products #product-3 .part-1::before {
        /* background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center; */
        background-size: cover;
    }

    .section-products #product-4 .part-1::before {
        /* background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center; */
        background-size: cover;
    }

    .section-products .single-product .part-1 .discount,
    .section-products .single-product .part-1 .new {
        position: absolute;
        top: 15px;
        left: 20px;
        color: #ffffff;
        background-color: #fe302f;
        padding: 2px 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .section-products .single-product .part-1 .new {
        left: 0;
        background-color: #444444;
    }

    .section-products .single-product .part-1 ul {
        position: absolute;
        bottom: -41px;
        left: 20px;
        margin: 0;
        padding: 0;
        list-style: none;
        opacity: 0;
        transition: bottom 0.5s, opacity 0.5s;
    }

    .section-products .single-product:hover .part-1 ul {
        bottom: 30px;
        opacity: 1;
    }

    .section-products .single-product .part-1 ul li {
        display: inline-block;
        margin-right: 4px;
    }

    .section-products .single-product .part-1 ul li a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color: #ffffff;
        color: #444444;
        text-align: center;
        box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
        transition: color 0.2s;
    }

    .section-products .single-product .part-1 ul li a:hover {
        color: #fe302f;
    }

    .section-products .single-product .part-2 .product-title {
        font-size: 1rem;
    }

    .section-products .single-product .part-2 h4 {
        display: inline-block;
        font-size: 1rem;
    }

    .section-products .single-product .part-2 .product-old-price {
        position: relative;
        padding: 0 7px;
        margin-right: 2px;
        opacity: 0.6;
    }

    .section-products .single-product .part-2 .product-old-price::after {
        position: absolute;
        content: "";
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #444444;
        transform: translateY(-50%);
    }
</style>
   

    <section class="section-products">
		<div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h3>Featured Product</h3>
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
            <div  style="display: flex;flex-wrap: wrap; text-align:center;align-items: center;justify-content: center ;" class="row">
                
            <?php
                if(!empty($data['products'])){
                    foreach($data['products'] as $product){
                ?>
            
                <!-- Single Product -->
                <div  class="col-md-6 col-lg-4 col-xl-3">
                    <div style="box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;" id="product-1" class="single-product">
                        <div  class="part-1">

                            <?php  
                                if($product['price'] > $product['price_sale']){
                                    ?>
                                        <span class="discount">
                                            Giảm<span><p style="color:#4fe91d;"><b><?php echo round(( ($product['price'] - $product['price_sale']) / $product['price']) * 100); ?> %</b></p></span>
                                        </span>
                                    <?php
                                }
                            ?>

                            <img style="padding:6px;width:100%;height:100%;object-fit: contain;" src="
                                <?php
                                    if(!empty($product['images'])){
                                        echo '/' . $product['images'];
                                    }else{
                                        echo '';
                                    }
                                ?>
                            " alt="">
                            <ul>
                                <li><a href="/addToCart"><i class="fas fa-shopping-cart"></i></a></li>
                                <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                <li><a href="/product?slug=<?php echo $product['slug'] ?>"><i class="fa-solid fa-list-ul"></i></a></li>
                                <li><a href="#"><i class="fas fa-plus"></i></a></li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title"><b><?php echo $product['name']; ?></b></h3>
                            <?php 
                                if($product['price'] > $product['price_sale']){
                                    ?>
                                        <h4 class="product-old-price"><?php echo currency_format($product['price']); ?></h4>
                                        <h4 class="product-price"><?php echo currency_format($product['price_sale']); ?></h4>
                                    <?php
                                }else{
                                    ?>
                                    <h4 class="product-price"><?php echo currency_format($product['price_sale']); ?></h4>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>


                 <?php
                    }
                }    
            ?>

            </div>
		</div>
    </section>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../assets/js/scripts.js"></script>
    </body>
</html>

<?php
    include_once(__DIR__.'./component/footer.php');
?>