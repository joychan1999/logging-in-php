<?php
session_start();
include 'header.php';
include './connection/storing_con.php';
$store = new Databases();

if (isset($_POST['login'])) {
    $res = $store->login($_POST['username'], $_POST['password']);
    $_SESSION['usedID'] = $res['id'];
    $_SESSION['username'] = $res['username'];
    $_SESSION['contactNum'] = $res['contactNumber'];
    if ($res['type'] == 'buyer') {
        header('Location: ./connection/buyer.php');
    } elseif ($res['type'] == 'seller' && $res['status'] == 0) {
        header('Location: ./connection/seller.php');
    } elseif ($res['type'] == 'seller' && $res['status'] == 1) {
        echo "<script>alert('Your submission as seller is not approved by the admin yet! Please wait until the admin will approve your submission!')</script>";
    }
}//end of sign in

if (isset($_POST['signup'])) {
    if ($_POST['type'] == 'seller') {
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
            <li class="nav-item"> <a href="index.php"><img class="logo" src="images/logo.png" alt="#"></a></li>

            <li class="nav-item" style="font-size:40px; margin-top: 20px;">
                <h1 class="h1">Green <br> Planthom</h1>
            </li>
            <li class="nav-item" id="secnav">
                <div class="input-group">
                    <input id="input" type="search" class="form-control" placeholder="Search Plants">
                    <button class="btn btn-success" onclick="myFunction()" type="button" id="searchButton">
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
                        <div class="row" id="myItems">
                            <?php
                            $products = $store->select('products', 'Orchid');
                            foreach ($products as $item) {
                                ?>
                            <div class="column">
                                <div class="card container-fluid">
                                        <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" class="image"
                                            data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"
                                            href="">
                                            <h2><?= $item['name']; ?></h2>
                                        </a>
                                        <p class="price">$<?= $item['price']; ?></p>
                                        <a href="#" data-name="<?= $item['name']; ?>"
                                            data-price="<?= $item['price']; ?>"
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
                                    <div class="card-body">
                                        <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" class="image"
                                            data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                        <a data-bs-toggle="modal" data-bs-target="#<?= $item['name']; ?>"
                                            data-bs-whatever="@mdo" href="">
                                            <h2 class="card-title"><?= $item['name']; ?></h2>
                                        </a>
                                        <p class="price">$<?= $item['price']; ?></p>
                                        <a href="#" data-name="<?= $item['name']; ?>"
                                            data-price="<?= $item['price']; ?>"
                                            class="add-to-cart btn btn-outline-success">Add to cart</a>
                                    </div>
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
                                    <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name']; ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name']; ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price']; ?></p>
                                    <a href="#" data-name="<?= $item['name']; ?>" data-price="<?= $item['price']; ?>"
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
                                    <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name']; ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name']; ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price']; ?></p>
                                    <a href="#" data-name="<?= $item['name']; ?>" data-price="<?= $item['price']; ?>"
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
                                    <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" class="image"
                                        data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#<?= $item['name']; ?>"
                                        data-bs-whatever="@mdo" href="">
                                        <h2><?= $item['name']; ?></h2>
                                    </a>
                                    <p class="price">$<?= $item['price']; ?></p>
                                    <a href="#" data-name="<?= $item['name']; ?>" data-price="<?= $item['price']; ?>"
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




    <script>
    function myFunction() {
        var input, filter, cards, cardContainer, h5, title, i;
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("myItems");
        cards = cardContainer.getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector("h2");
            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
    // $(document).ready(function() {
    //     $("#searchButton").click(function() {
    //         // alert("naclick ra sya");
    //         $('.card').removeClass('d-none');
    //         var filter = $(this).val(); // get the value of the input, which we filter on
    //         $('.card-deck').find('.card h2:not(:contains("' + filter + '"))').parent().addClass('d-none');
    //         // var value = $("#input").val().toLowerCase();
    //         // $("#myTable tr").filter(function() {
    //         //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         // });
    //     });
    // });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

</body>