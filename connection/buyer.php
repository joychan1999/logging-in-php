<?php
session_start();
include 'storing_con.php';
$store = new Databases();
$id = $_SESSION['usedID'];
// //fetch user data
$sql = "SELECT * FROM users WHERE id = '$id'";
$row = $store->userDetails($sql);
// echo 'console.log('.$row['username'].')';

if (isset($_POST['addnew'])) {
    $id = $_SESSION['usedID'];
    $subtotal = $_POST['quantity'] * $_POST['price'];
    $cartItems = $store->addToCart($id, $_POST['sellerID'], $_POST['image'], $_POST['quantity'], $_POST['price'], $subtotal, $_POST['name']);
    if ($cartItems) {
        echo '<script>alert("Item added to cart successfully!")</script>';
    } else {
        echo '<script>alert("FAiled")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <title>GreenPlanthom</title>
</head>
<link rel="stylesheet" href="../css/buyer.css">

<body class="body">
    <div id="navigationBar">
        <ul class="nav justify-content-end" id="navs">
            <li class="nav-item mt-1">
                <a class="nav-link" href="help.php"> <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/135-256.png" alt="" class="imgicon"> Help</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="dropbtn" src="https://cdn4.iconfinder.com/data/icons/web-design-and-development-6-4/128/279-256.png" alt="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#personalInfo" data-bs-whatever="@mdo">Personal Info</a></li>
                    <li><a class="dropdown-item" href="orders.php">My Orders</a></li>
                    <li><a class="dropdown-item" href="../index.php">Log out</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item"> <a href="#"><img class="logo" src="../images/logo.png" alt="#"></a></li>

            <li class="nav-item" style="font-size:40px; margin-top: 10px;">
                <h1 class="h1">Green <br> Planthom</h1>
            </li>
            <li class="nav-item" id="secnav">
                <div class="input-group">
                    <input id="input" type="text" class="form-control" placeholder="Search Plants">
                    <button class="btn btn-success" type="button">
                        <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-squares-01/3/75-128.png" alt="search" style="width: 40px; height: 36px;">
                    </button>
                        <?php
                            $id = $_SESSION['usedID'];
                            $_SESSION['count'] = 0;
                            $result = $store->countCart($id);
                            if ($result == 0) {
                                $_SESSION['count'] = 0;
                            } else {
                                $_SESSION['count'] = $result;
                            }
                                ?>
                            <a href="cart.php" type="button" class="btn btn-success " style="float: left;">
                                <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/shopping-circle-green-256.png" alt="cart" style="width: 40px; height: 36px;">
                                <span class="total-count" style="margin-left: 3px;"><?= $_SESSION['count']; ?></span>
                            </a>
                       
                </div>
            </li>

        </ul>
    </div>
    <div class="bodyContent " style="padding: 50px;">
        <div class="row">
            <div class="col-3" style="position: fixed;margin-top: 160px;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action  active" id="list-home-list" data-bs-toggle="list" href="#list-orchids" role="tab" aria-controls="orchids">Orchids</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-daisy" role="tab" aria-controls="daisy">Daisies</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-succulents" role="tab" aria-controls="succulents">Succulents</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-rose" role="tab" aria-controls="rose">Roses</a>
                    <a class="list-group-item list-group-item-action" id="list-other-list" data-bs-toggle="list" href="#list-other" role="tab" aria-controls="rose">Others</a>
                </div>
            </div>

            <!-- -----------------PRODUCTS------------------ -->

            <div class="col" style="margin-right:50px, width:100%">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-orchids" role="tabpanel" aria-labelledby="list-home-list">
                        <h1 style="color: purple;">ORCHIDS</h1>
                        <hr style="color: purple;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Orchid');
                            foreach ($products as $prod) {
                                ?>
                                <div class="column">
                                    <div class="card">
                                        <form method="POST">
                                            <center>
                                                <input type="text" name="sellerID" value="<?= $prod['sellerID']; ?>" hidden>
                                                <input type="text" name="image" value="<?= $prod['image_url']; ?>" hidden>
                                                <input type="text" name="name" value="<?= $prod['name']; ?>" hidden>
                                                <input type="text" name="price" value="<?= $prod['price']; ?>" hidden>
                                                <img src="<?= $prod['image_url']; ?>" alt="<?= $prod['name']; ?>" class="image" data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo">
                                                <a data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo" href="">
                                                    <h2><?= $prod['name']; ?></h2>
                                                </a>
                                                <a class="price" style="color:black">$<?= $prod['price']; ?></a><br>
                                                Quantity:<input type="number" name="quantity" style="width: 35px" value="0">
                                                <button type="submit" name="addnew" class="add-to-cart btn btn-outline-success">Add to cart</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-daisy" role="tabpanel" aria-labelledby="list-profile-list">
                        <h1 style="color:darkorchid;">Daisies</h1>
                        <hr style="color:darkorchid;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Daisy');
                            foreach ($products as $prod) {
                                ?>
                                <div class="column">
                                    <div class="card">
                                    <form method="POST">
                                            <center>
                                                <input type="text" name="sellerID" value="<?= $prod['sellerID']; ?>" hidden>
                                                <input type="text" name="image" value="<?= $prod['image_url']; ?>" hidden>
                                                <input type="text" name="name" value="<?= $prod['name']; ?>" hidden>
                                                <input type="text" name="price" value="<?= $prod['price']; ?>" hidden>
                                                <img src="<?= $prod['image_url']; ?>" alt="<?= $prod['name']; ?>" class="image" data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo">
                                                <a data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo" href="">
                                                    <h2><?= $prod['name']; ?></h2>
                                                </a>
                                                <a class="price" style="color:black">$<?= $prod['price']; ?></a><br>
                                                Quantity:<input type="number" name="quantity" style="width: 35px" value="0">
                                                <button type="submit" name="addnew" class="add-to-cart btn btn-outline-success">Add to cart</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-succulents" role="tabpanel" aria-labelledby="list-messages-list">
                        <h1 style="color:green;">SUCCULENTS</h1>
                        <hr style="color:green;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Succulent');
                            foreach ($products as $prod) {
                                ?>
                                <div class="column">
                                    <div class="card">
                                    <form method="POST">
                                            <center>
                                                <input type="text" name="sellerID" value="<?= $prod['sellerID']; ?>" hidden>
                                                <input type="text" name="image" value="<?= $prod['image_url']; ?>" hidden>
                                                <input type="text" name="name" value="<?= $prod['name']; ?>" hidden>
                                                <input type="text" name="price" value="<?= $prod['price']; ?>" hidden>
                                                <img src="<?= $prod['image_url']; ?>" alt="<?= $prod['name']; ?>" class="image" data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo">
                                                <a data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo" href="">
                                                    <h2><?= $prod['name']; ?></h2>
                                                </a>
                                                <a class="price" style="color:black">$<?= $prod['price']; ?></a><br>
                                                Quantity:<input type="number" name="quantity" style="width: 35px" value="0">
                                                <button type="submit" name="addnew" class="add-to-cart btn btn-outline-success">Add to cart</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-rose" role="tabpanel" aria-labelledby="list-settings-list">
                        <h1 style="color: red;">ROSES</h1>
                        <hr style="color: red;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Rose');
                            foreach ($products as $prod) {
                                ?>
                                <div class="column">
                                    <div class="card">
                                    <form method="POST">
                                            <center>
                                                <input type="text" name="sellerID" value="<?= $prod['sellerID']; ?>" hidden>
                                                <input type="text" name="image" value="<?= $prod['image_url']; ?>" hidden>
                                                <input type="text" name="name" value="<?= $prod['name']; ?>" hidden>
                                                <input type="text" name="price" value="<?= $prod['price']; ?>" hidden>
                                                <img src="<?= $prod['image_url']; ?>" alt="<?= $prod['name']; ?>" class="image" data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo">
                                                <a data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo" href="">
                                                    <h2><?= $prod['name']; ?></h2>
                                                </a>
                                                <a class="price" style="color:black">$<?= $prod['price']; ?></a><br>
                                                Quantity:<input type="number" name="quantity" style="width: 35px" value="0">
                                                <button type="submit" name="addnew" class="add-to-cart btn btn-outline-success">Add to cart</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-other" role="tabpanel" aria-labelledby="list-other-list">
                        <h1 style="color:purple;">OTHERS</h1>
                        <hr style="color:purple;">
                        <div class="row">
                            <?php
                            $products = $store->select('products', 'Other');
                            foreach ($products as $prod) {
                                ?>
                                <div class="column">
                                    <div class="card">
                                    <form method="POST">
                                            <center>
                                                <input type="text" name="sellerID" value="<?= $prod['sellerID']; ?>" hidden>
                                                <input type="text" name="image" value="<?= $prod['image_url']; ?>" hidden>
                                                <input type="text" name="name" value="<?= $prod['name']; ?>" hidden>
                                                <input type="text" name="price" value="<?= $prod['price']; ?>" hidden>
                                                <img src="<?= $prod['image_url']; ?>" alt="<?= $prod['name']; ?>" class="image" data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo">
                                                <a data-bs-toggle="modal" data-bs-target="#<?= $prod['name']; ?>" data-bs-whatever="@mdo" href="">
                                                    <h2><?= $prod['name']; ?></h2>
                                                </a>
                                                <a class="price" style="color:black">$<?= $prod['price']; ?></a><br>
                                                Quantity:<input type="number" name="quantity" style="width: 35px" value="0">
                                                <button type="submit" name="addnew" class="add-to-cart btn btn-outline-success">Add to cart</button>
                                            </center>
                                        </form>
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

    <!-- -----------------PRODUCT INFORMATION------------------------------- -->
    <!-- <div class="modal fade" id="cattleya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <img src="./images/sampleimageforcont/p1.jfif" class="bigPhoto" />
                                        </div>
                                        <div class="mySlides ">
                                            <div class="numbertext">2 / 5</div>
                                            <img src="./images/sampleimageforcont/r1.jfif" class="bigPhoto" />
                                        </div>
                                        <div class="mySlides">
                                            <div class="numbertext">3 / 5</div>
                                            <img src="./images/sampleimageforcont/p2.jfif" class="bigPhoto" />
                                        </div>
                                        <div class="mySlides ">
                                            <div class="numbertext">4 / 5</div>
                                            <img src="./images/sampleimageforcont/r2.jfif" class="bigPhoto" />
                                        </div>
                                        <div class="mySlides">
                                            <div class="numbertext">5 / 5</div>
                                            <img src="./images/sampleimageforcont/p3.jfif" class="bigPhoto" />
                                        </div>

                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    </div>
                                    <div class="row justify-content-md-center mt-4 mb-3">
                                        <img src="./images/sampleimageforcont/p1.jfif" class="smallpic" onclick="currentSlide(1)" />
                                        <img src="./images/sampleimageforcont/r1.jfif" class="smallpic" onclick="currentSlide(2)" />
                                        <img src="./images/sampleimageforcont/p2.jfif" class="smallpic" onclick="currentSlide(3)" />
                                        <img src="./images/sampleimageforcont/r2.jfif" class="smallpic" onclick="currentSlide(4)" />
                                        <img src="./images/sampleimageforcont/p3.jfif" class="smallpic" onclick="currentSlide(5)" />
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
                                    <h3 class="text-center">Red African Rose</h3>
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
                                            <div class="input-group mb-3 mt-5" style="margin-right: 2%;margin-left: 3%;">
                                                <div class="input-group-prepend ">
                                                    <label class="input-group-text bg-success rounded-left" for="inputGroupSelect02" style="height:50px; color: white;">Quantity</label>
                                                </div>
                                                <select class="custom-select rounded-right" id="inputGroupSelect02" style="height:auto;">
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
    </div> -->


    <!---------------------- MODAL CART------------------------- -->
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

    <!----------------    PERSONAL INFO MODAL  ------------------->

    <div class="modal fade" id="personalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Personal Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row" style="margin-left:50px">
                            <div class="col-sm-4">
                                <img src="./images/profile_icon.jfif" class="rounded float-start" alt="profie">
                            </div>
                            <div class="col-sm-6">
                                <p class="lead">Username</p>
                                <div class="input-group " style="margin-bottom:15px;">

                                    <input type="text" class="edit-inputUser form-control w-50" value="<?= $row['username']; ?>" disabled>
                                    <button class="btn-editUser btn btn-outline-primary" type="button">Edit</button>
                                </div>
                                <p class="lead">Password</p>
                                <div class="input-group" style="margin-bottom:15px;">
                                    <input type="password" class="edit-inputPass form-control w-50" value="<?= $row['password']; ?>" disabled>
                                    <button class="btn-editPass btn btn-outline-primary" type="button">Edit</button>
                                </div>
                                <p class="lead">Retype Password</p>
                                <div class="input-group" style="margin-bottom:15px;">
                                    <input type="password" class="edit-inputRePass form-control w-50" value="" disabled>
                                </div>
                                <p class="lead">Email Address</p>
                                <div class="input-group" style="margin-bottom:15px;">
                                    <input type="text" class="edit-inputAdd form-control w-50" value="<?= $row['email']; ?>" disabled>
                                    <button class="btn-editAdd btn btn-outline-primary" type="button">Edit</button>
                                </div>
                                <p class="lead">Contact Number</p>
                                <div class="input-group" style="margin-bottom:15px;">
                                    <input type="text" class="edit-inputCon form-control w-50" value="<?= $row['contactNumber']; ?>" disabled>
                                    <button class="btn-editCon btn btn-outline-primary" type="button">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./index.js"></script>


    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>