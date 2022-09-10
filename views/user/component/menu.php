<!-- Navigation-->
<style>
    *::-webkit-scrollbar {
    width: 10px;
    }
    *::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 6px;
    } 
    .dropdown-menu {
        display:block;
    }
    .navbar{
        z-index: 10;
        position:sticky;
        top: 0;
        left: 0;
    }
    a b{
        font-family: 'Bowlby One', cursive;
        text-transform: uppercase;
        background-image: linear-gradient(
            -225deg,
            #231557 0%,
            #44107a 29%,
            #ff1361 67%,
            #fff800 100%);
        background-size: auto auto;
        background-clip: border-box;
        background-size: 200% auto;
        color: #fff;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 2s linear infinite;
        display: inline-block;
        }

        @keyframes textclip {
        to {
            background-position: 200% center;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container px-4 px-lg-5">
        <img style="margin-right:10px;" src="/assets/upload/logoo.png" width="60px" height="40px" alt="">
        <a class="navbar-brand" href="/"><b>Mobile Store</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form style="width:500px; height:40px;margin-left:13%;" class="d-flex" action="/search" method="get">
            <input class="form-control me-2"
                type="search"
                name="keyword"
                placeholder="Nhập tên sản phẩm..."
                value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>"
                aria-label="Search">
            <button style="width:65px" class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    
                </li>
            </ul>
            <a style="text-decoration: none;" href="/carts" class="d-flex">
                
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                        Giỏ hàng
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php
                            if(!empty($_SESSION['carts'])){
                                echo count($_SESSION['carts']);
                                // echo count((array)$_SESSION['carts']);
                                // echo count($_SESSION['carts']);
                            }else{
                                echo 0;
                            }
                            // if(!empty($_SESSION['carts'])) {
                            //     echo count($_SESSION['carts']);
                            // } else {
                            //     echo 0;
                            // }
                            // print_r(($_SESSION['carts']));
                        ?>
                    </span>
                </button>
            </a>

            <!-- <form action="/login" >
                <input style="width: 90px;" class="btn btn-primary mb-2" type="submit" value="Login">
            </form> -->

            <!-- <?php
                // if(!empty($_SESSION['user'])){
                    ?>
                        <a class="btn btn-primary "  href="/myOrder">Your Orders</a>
                        <button class="btn btn-warning"> <b><i>@username:&nbsp 
                            <?php 
                                // echo $_SESSION['user']['name'] 
                            ?>
                            !</i></b> </button>
                        <form  action="/logout" method="post" >
                            <input style="width: 90px;" class="btn btn-primary mb-2" type="submit" value="Log out">
                        </form>
                    <?php
                // }else{
                    ?>
                        <a style="margin-left:10px;" class="btn btn-primary " href="/login">Login</a>
                    <?php
                // }
            ?> -->
        </div>
    </div>

    

    <div style="margin-right:6px;" class="dropdown">
        <style>
            .dropbtn {
                background-color: #4CAF50;
                color: white;
                /* padding: 16px; */
                font-size: 14px;
                border: none;
                cursor: pointer;
                }

                .dropdown {
                position: relative;
                display: inline-block;
                }

                .dropdown-content {
                display: none;
                position: absolute;
                right:40px;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                }

                .dropdown-content::before{
                    content: '';
                    position: absolute;
                    top: -8px;
                    left: 71px;
                    width: 0;
                    height: 0;
                    border-left: 10px solid transparent;
                    border-right: 10px solid transparent;
                    border-bottom: 9px solid #99eaa8;
                    transition: all ease 1s;
                }

                .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                }

                .dropdown-content a:hover {background-color: #f1f1f1}

                .dropdown:hover .dropdown-content {
                display: block;
                }

                .dropdown:hover .dropbtn {
                background-color: #3e8e41;
                }
        </style>

        

        <?php
        if(!empty($_SESSION['user'])){
            ?>
            <button style="color:#000;width:250px; background-color: #ffc107;" class="dropbtn ">
                <img style="border-radius:50% ;object-fit:cover;" width="36px" height="36px" src="<?php echo $_SESSION['user']['avatar']; ?>" alt="">
                <b><i>@<?php echo $_SESSION['user']['name'] ?></i></b>
            </button>
            <div style="height:100px;" class="dropdown-content">
                <a style="color:#000;background-color:#3adc5780;" class="btn btn-secondary "  href="/myOrder">My Orders</a>

                <!-- <a style="width: 100%;" class="btn btn-secondary "> -->
                    <form   action="/logout" method="post" >
                        <input style="width: 100%;color:#000;padding:12px 0;background-color:#3adc5780;" class="btn btn-secondary mb-2" type="submit" value="Log Out">
                    </form>
                <!-- </a> -->

            </div>
            <?php
        }else{
            ?>
                <a style="margin-left:10px;" class="btn btn-primary " href="/login">Login</a>
                <a style="margin-left:10px;" class="btn btn-secondary " href="/register">Register</a>
            <?php
        }
        ?>
        
    </div>
</nav>

<?php 
    // var_dump($data['menuCategoriesProduct']);
 ?>