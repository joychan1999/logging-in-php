<?php
session_start();
include 'header.php';
include './connection/storing_con.php';
$store = new Databases();


if (isset($_POST['login'])) {
    $res = $store->login($_POST['username'], $_POST['password']);
    $_SESSION['usedID'] = $res['id'];
    if ($res['type'] == "buyer") {
        header('Location: ./connection/buyer.php');
    } else if ($res['type'] == "seller" && $res['status'] == 0) {
        header('Location: ./connection/seller.php');
    } else if ($res['type'] == "seller" && $res['status'] == 1) {
        echo "<script>alert('Your submission as seller is not approved by the admin yet! Please wait until the admin will approve your submission!')</script>";
    }
}//end of sign in

if (isset($_POST['signup'])) {
    if ($_POST['type'] == "seller") {
        $stat = 1;
    } else {
        $stat = 0;
    }
    $sign = $store->signup($_POST['username'], $_POST['password'], $_POST['email'], $_POST['contactNumber'], $_POST['type'], $stat);
    if ($sign) {
        echo '<script>alert("signed up successfully, please log in your account!")</script>';
    }
}//end of sign up

?>
<link rel="stylesheet" href="./css/index.css">

<body class="body">
    <div id="navigationBar">
        <ul class="nav justify-content-end" id="navs">
            <li class="nav-item">
                <a class="nav-link" href="./help.html"> <img
                        src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/135-256.png"
                        alt="" class="imgicon"> Help</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4q4eyqUndMHmc7uxRPn2hVEsB1w6XfGSMtQ&usqp=CAU"
                        alt="" class="imgicon"> Sign up
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#signup-as-seller"
                            data-bs-whatever="@mdo" href="#">Sign up</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4q4eyqUndMHmc7uxRPn2hVEsB1w6XfGSMtQ&usqp=CAU"
                        alt="" class="imgicon">Log in
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#login-as-seller"
                            data-bs-whatever="@mdo" href="#">Log in</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item"> <a href="#"><img class="logo" src="images/logo.png" alt="#"></a></li>

            <li class="nav-item" style="font-size:40px; margin-top: 20px;">
                <h1 class="h1">Green <br> Planthom</h1>
            </li>
            <li class="nav-item" id="secnav">
                <div class="input-group">
                    <input id="input" type="text" class="form-control" placeholder="Search Plants">
                    <button class="btn btn-success" type="button">
                        <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-squares-01/3/75-128.png"
                            alt="search" style="width: 40px; height: 36px;">
                    </button>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#cart"
                        style="float: left;">
                        <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/shopping-circle-green-256.png"
                            alt="cart" style="width: 40px; height: 36px;"><span class="total-count"
                            style="margin-left: 5px;"></span>
                    </button>
                </div>
            </li>

        </ul>
    </div>

    <div class="bodyContent " style="padding: 50px;">
        <div class="row">
            <div class="col-3 " style="position: fixed;margin-top: 160px;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action  active" id="list-home-list" data-bs-toggle="list"
                        href="#list-home" role="tab" aria-controls="home">Orchids</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                        href="#list-profile" role="tab" aria-controls="profile">Daisies</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list"
                        href="#list-messages" role="tab" aria-controls="messages">Succulents</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list"
                        href="#list-settings" role="tab" aria-controls="settings">Roses</a>
                    <a class="list-group-item list-group-item-action" id="list-other-list" data-bs-toggle="list"
                        href="#list-other" role="tab" aria-controls="settings">Others</a>
                </div>
            </div>
            <div class="col">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                        aria-labelledby="list-home-list">
                        <h1 style="color: purple;">ORCHIDS</h1>
                        <hr style="color: purple;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Orchid');
                            foreach ($products as $item) {
                            ?>
                            <div class="column">
                                <div class="card container-fluid">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"
                                        href="">
                                        <h2><?= $item['name'] ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price'] ?></p>
                                    <a href="#" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"
                                        class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <h1 style="color:darkorchid;">Daisies</h1>
                        <hr style="color:darkorchid;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Daisy');
                            foreach ($products as $item) {
                            ?>
                            <div class="column">
                                <div class="card">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name'] ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price'] ?></p>
                                    <a href="#" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"
                                        class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        <h1 style="color:green;">SUCCULENTS</h1>
                        <hr style="color:green;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Succulent');
                            foreach ($products as $item) {
                            ?>
                            <div class="column">
                                <div class="card">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name'] ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price'] ?></p>
                                    <a href="#" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"
                                        class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <h1 style="color: red;">ROSES</h1>
                        <hr style="color: red;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Rose');
                            foreach ($products as $item) {
                            ?>
                            <div class="column">
                                <div class="card">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name'] ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price'] ?></p>
                                    <a href="#" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"
                                        class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-other" role="tabpanel" aria-labelledby="list-other-list">
                        <h1 style="color:purple;">Others</h1>
                        <hr style="color:purple;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Other');
                            foreach ($products as $item) {
                            ?>
                            <div class="column">
                                <div class="card">
                                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name'] ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price'] ?></p>
                                    <a href="#" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>"
                                        class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--------------------------- SIGN UP ----------------------->
    <div class="modal fade" id="signup-as-seller" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Sign Up</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="imgcontainer">
                        <img src="https://cdn2.iconfinder.com/data/icons/peppyicons/512/men_green-256.png" alt="Avatar"
                            class="avatar">
                    </div>
                    <br>
                    <form method="POST">
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons"
                                        style="font-size:35px;color:rgb(51, 196, 7)">account_circle</i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons"
                                        style="font-size:35px;color:rgb(51, 196, 7)">visibility_off</i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons"
                                        style="font-size:35px;color:rgb(51, 196, 7)">email</i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons"
                                        style="font-size:35px;color:rgb(51, 196, 7)">contact_phone</i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons"
                                        style="font-size:35px;color:rgb(51, 196, 7)">perm_identity</i></span>
                            </div>
                            <!-- <input type="text" class="form-control" value="seller" name="userType" readonly> -->
                            <select id="category" name="type" style="width: 87%;">
                                <option value="seller">seller</option>
                                <option value="buyer">buyer</option>
                            </select>
                        </div>
                        <center>
                            <p class="lead">Do you have an account?<a data-bs-toggle="modal" data-bs-target="#login"
                                    class="login" data-bs-whatever="@mdo" href="" style="text-decoration:none;">
                                    <b>Login</b></a></p>
                            <span><button type="submit" name="signup"
                                    class="btn btn-outline-success btn-lg btn-block">Sign Up</button>
                            </span>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------- LOG IN AS BUYER -------------------------->
    <div class="modal fade" id="login-as-seller" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Login</h4>
                    <button type="button" class="showModal btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" style="max-width:500px;margin:auto">

                        <div class="imgcontainer">
                            <img src="https://cdn2.iconfinder.com/data/icons/peppyicons/512/men_green-256.png"
                                alt="Avatar" class="avatar">
                        </div>
                        <div class="center2">
                            <div class="input-container">
                                <i class="fa fa-user icon bg-success"></i>
                                <input class="input-field" type="text" placeholder="Username" name="username">
                            </div>
                            <div class="input-container">
                                <i class="fa fa-key icon bg-success"></i>
                                <input class="input-field" type="password" placeholder="Password" name="password">
                            </div>
                            <input type="submit" class="btn bg-success" id="login" value="Log In" name="login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!------------------------ MODAL CART -------------------->
    <!-- <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="show-cart table">

                    </table>
                    <div>Total price: $<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                    <button class="clear-cart btn btn-danger" style="float: left;">Clear Cart</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Order now</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- -----------------PRODUCT INFORMATION------------------------------- -->
    <div class="modal fade" id="cattleya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="container mb-5" style="background-color: whitesmoke;">
                            <div class="row">
                                <div class="col">
                                    <div class="slideshow-container">
                                        <div class="mySlides ">
                                            <div class="numbertext">1 / 5</div>
                                            <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids1.jpg"
                                                class="bigPhoto" />
                                        </div>
                                        <div class="mySlides ">
                                            <div class="numbertext">2 / 5</div>
                                            <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids2.jfif"
                                                class="bigPhoto" />
                                        </div>
                                        <div class="mySlides">
                                            <div class="numbertext">3 / 5</div>
                                            <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids3.jpg"
                                                class="bigPhoto" />
                                        </div>
                                        <div class="mySlides ">
                                            <div class="numbertext">4 / 5</div>
                                            <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids4.jfif"
                                                class="bigPhoto" />
                                        </div>
                                        <div class="mySlides">
                                            <div class="numbertext">5 / 5</div>
                                            <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids5.jfif"
                                                class="bigPhoto" />
                                        </div>

                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    </div>
                                    <div class="row justify-content-md-center mt-4 mb-3">
                                        <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids1.jpg"
                                            class="smallpic" onclick="currentSlide(1)" />
                                        <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids2.jfif"
                                            class="smallpic" onclick="currentSlide(2)" />
                                        <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids3.jpg"
                                            class="smallpic" onclick="currentSlide(3)" />
                                        <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids4.jfif"
                                            class="smallpic" onclick="currentSlide(4)" />
                                        <img src="./images/orchids/Orchids/Cattleya Orchids/Cattleya Orchids5.jfif"
                                            class="smallpic" onclick="currentSlide(5)" />
                                    </div>
                                    <div class="mt-5">
                                        <div class="row justify-content-md" style="margin-left:30px;">
                                            <div class="d-flex flex-row">
                                                <div class="p-1">
                                                    <img src="./images/logo.png" class="logo1" alt="Shop Logo">
                                                </div>
                                                <div class="p-2 mt-1">
                                                    <h5>OneStopShop</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-left:85px;margin-block-end:10%;">
                                            <button class="btn button text-center">
                                                <ion-icon name="logo-wechat"></ion-icon> Chat Now
                                            </button>
                                            <button class="btn button text-center">
                                                <ion-icon name="storefront-outline"></ion-icon> View Shop
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"><br><br>
                                    <h3 class="text-center">Cattleya</h3>
                                    <div style="margin-right: 5%;">
                                        <div class="text-center">
                                            <p>
                                                A rose is a woody perennial flowering plant of the genus Rosa,
                                                in the family Rosaceae, or the flower it bears. There are over
                                                three hundred species and tens of thousands of cultivars. They
                                                form a group of plants that can be erect shrubs, climbing, or
                                                trailing, with stems that are often armed with sharp prickles.
                                            </p>
                                        </div>
                                        <div class="mt-5">
                                            <span><b>Price: 120/pot</b></span>
                                        </div>
                                        <div class="mt-3" style="margin-left: 2%;">
                                            <span style="font-size: small;">100 pieces available </span>
                                        </div>
                                        <div class="row">
                                            <div class="input-group mb-3 mt-5"
                                                style="margin-right: 2%;margin-left: 3%;">
                                                <div class="input-group-prepend ">
                                                    <label class="input-group-text bg-success rounded-left"
                                                        for="inputGroupSelect02"
                                                        style="height:50px; color: white;">Quantity</label>
                                                </div>
                                                <select class="custom-select rounded-right" id="inputGroupSelect02"
                                                    style="height:auto;">
                                                    <option selected>Choose...</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                                &NonBreakingSpace; &NonBreakingSpace; &NonBreakingSpace;
                                                &NonBreakingSpace; &NonBreakingSpace;
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-success btn-lg">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                                <div class="mt-5 text-center">
                                                    <p class="text-justify " style="font-size:15px">
                                                        <i><b>Note: </b> To our valued customer, we have set a
                                                            maximum quantity of 4 pots per transaction since the box
                                                            can't contain more than the specified number. As well as
                                                            to avoid unnecessary damage during the transport. If you
                                                            want to order more quantity, you have to set another
                                                            transaction. Thank you and Happy Shopping Everyone.
                                                        </i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <script>
    // ---------------PRODUCT INFORMATIONS SLIDE PICTURES----------------------
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides((slideIndex += n));
    }

    function currentSlide(n) {
        showSlides((slideIndex = n));
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var pics = document.getElementsByClassName("smallpic");
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < pics.length; i++) {
            pics[i].className = pics[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        pics[slideIndex - 1].className += " active";
    }




    $(document).ready(function() {

        $(function() {
            $('[data-toggle="tooltip "]').tooltip()
        });



        $('.status').click(function() {
            $("#status").html("Complete");
        });


    });
    </script>

    <!-- <script src="./index.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

</body>