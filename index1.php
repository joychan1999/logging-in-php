<?php
session_start();
include 'header.php';
include './connection/connection.php';
include './connection/functions.php';

// include '../logIn/connection/index1.php';
// if (isset($_POST['signup'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $email = $_POST['email'];
//     $contactNumber = $_POST['contactNumber'];
//     $type = $_POST['type'];

//     if (!empty($username) && !empty($password) && !is_numeric($username)) {
//         // save to database
//         $user_id = randomNum(20);
//         $query = "INSERT INTO users (user_id, username, password,email,contactNumber,type)VALUES ('$user_id', '$username', '$password','$email','$contactNumber','$type')";
//         // save the query
//         mysqli_query($con, $query);
//         echo "<script>alert('Account Created Successfully! <br> Please LogIn your account!')</script>";
//         header("Location: index.php");
//         die;
//     } else {
//         echo "<script> alert('please enter some valid informations,<br> Do not leave anything empty!')</script>";
//     }
// }

// if (isset($_POST['login'])) {
//     // something was posted
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     if (!empty($username) && !empty($password) && !is_numeric($username)) {

//         // read from database
//         $query = "select * from users where username = '$username' limit 1";
//         // save the query
//         $result = mysqli_query($con, $query);


//         if ($result) {
//             if ($result && mysqli_num_rows($result) > 0) {
//                 $user_data = mysqli_fetch_assoc($result);

//                 if ($user_data['password'] === $password && $user_data['type'] === "buyer") {

//                     $_SESSION['user_id'] = $user_data['user_id'];
                    // header("Location: ./connection/index1.php");
//                     die;
//                 } else if ($user_data['password'] === $password && $user_data['type'] === "seller") {
//                     $_SESSION['user_id'] = $user_data['user_id'];
//                     header("Location: ./connection/seller.php");
//                     die;
//                 } else {
//                     echo '<script>alert("Wrong username or password!")</script>';
//                 }
//             }
//         }
//     } else {
//         echo '<script>alert("Do not leave anything empty!")</script>';
//     }
// }


// $user_data = check_login($con);
?>

<link rel="stylesheet" href="./css/buyer.css">

<body class="body">
    <div id="navigationBar">
        <ul class="nav justify-content-end" id="navs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"><img class="imgicon" src="https://cdn1.iconfinder.com/data/icons/crime-and-security-3-7/48/106-256.png" alt="">Notification</a> <!-- use badge para sa notification add-->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./connection/help.php"> <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/135-256.png" alt="" class="imgicon"> Help</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="modal" data-bs-target="#signup-as-seller" data-bs-whatever="@mdo" aria-expanded="false">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4q4eyqUndMHmc7uxRPn2hVEsB1w6XfGSMtQ&usqp=CAU" alt="" class="imgicon"> Sign up
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"  role="button" data-bs-toggle="modal" data-bs-target="#login-as-buyer" data-bs-whatever="@mdo" aria-expanded="false">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4q4eyqUndMHmc7uxRPn2hVEsB1w6XfGSMtQ&usqp=CAU" alt="" class="imgicon">Log in
                </a>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item"> <a href="#"><img class="logo" src="images/logo.png" alt="#"></a></li>

            <li class="nav-item" style="font-size:40px; margin-top: 10px;">
                <h1 class="h1">Green <br> Planthom</h1>
            </li>
            <li class="nav-item" id="secnav">
                <div class="input-group">
                    <input id="input" type="text" class="form-control" placeholder="Search Plants">
                    <button class="btn btn-success" type="button">
                        <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-squares-01/3/75-128.png" alt="search" style="width: 40px; height: 36px;">
                    </button>
                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#cart" style="float: left;">
                        <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/shopping-circle-green-256.png" alt="cart" style="width: 40px; height: 36px;"><span class="total-count" style="margin-left: 5px;"></span>
                    </button>
                </div>
            </li>

        </ul>
    </div>
    <div class="bodyContent " style="padding: 40px;margin-top: 20px;">
        <div class="row">
            <div class="col-3 " style="position: fixed;margin-top: 160px;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-settings-list" data-bs-toggle="list" href="#list-others" role="tab" aria-controls="others">All</a>
                    <a class="list-group-item list-group-item-action" id="list-home-list" data-bs-toggle="list" href="#list-orchids" role="tab" aria-controls="orchids">Orchids</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-daisy" role="tab" aria-controls="daisy">Daisies</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-succulents" role="tab" aria-controls="succulents">Succulents</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-rose" role="tab" aria-controls="rose">Roses</a>

                </div>
            </div>

            <!-- -----------------PRODUCTS------------------ -->
            <div class="col">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade " id="list-orchids" role="tabpanel" aria-labelledby="list-home-list">
                        <h1 style="color: purple;">ORCHIDS</h1>
                        <hr style="color: purple;">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <img src="./images/orchids/cattleya.jfif" alt="Cattleya" class="image" data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo" href="">
                                        <h2>Cattleya</h2>
                                    </a>
                                    <p class="price">$19.99</p>
                                    <a href="#" data-name="Cattleya" data-price="19.99" class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-daisy" role="tabpanel" aria-labelledby="list-profile-list">
                        <h1 style="color:darkorchid;">Daisies</h1>
                        <hr style="color:darkorchid;">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <img src="./images/daisy/english-daisy.jpg" alt="Denim Jeans" class="image" data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo" href="">
                                        <h2>English Daisy</h2>
                                    </a>
                                    <p class="price">$19.99</p>
                                    <a href="#" data-name="English Daisy" data-price="19.99" class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-succulents" role="tabpanel" aria-labelledby="list-messages-list">
                        <h1 style="color:green;">SUCCULENTS</h1>
                        <hr style="color:green;">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <img src="./images/succulents/jade.jfif" alt="Denim Jeans" class="image" data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="">
                                        <h2>Jade</h2>
                                    </a>
                                    <p class="price">$19.99</p>
                                    <a href="#" data-name="Jade" data-price="19.99" class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-rose" role="tabpanel" aria-labelledby="list-settings-list">
                        <h1 style="color: red;">ROSES</h1>
                        <hr style="color: red;">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <img src="./images/roses/damask.jpg" alt="Damask Rose" class="image" data-bs-toggle="modal" data-bs-target="#cattleya" data-bs-whatever="@mdo">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="">
                                        <h2>Damask Rose</h2>
                                    </a>
                                    <p class="price">$19.99</p>
                                    <a href="#" data-name="Damask Rose" data-price="19.99" class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="list-others" role="tabpanel" aria-labelledby="list-settings-list">
                        <h1 style="color: blue;">All</h1>
                        <hr style="color: blue;">
                        <div class="row">
                            <div class="column">
                                <div class="card">
                                    <img src="./images/roses/lincoln.jfif" alt="Lincoln Rose" class="image">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="">
                                        <h2>Mr. Lincoln Rose</h2>
                                    </a>
                                    <p class="price">$19.99</p>
                                    <a href="#" data-name="Mr. Lincoln Rose" data-price="19.99" class="add-to-cart btn btn-outline-success">Add to cart</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---------------------- MODAL CART------------------------- -->
    <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <img src="https://cdn2.iconfinder.com/data/icons/peppyicons/512/men_green-256.png" alt="Avatar" class="avatar">
                    </div>
                    <br>
                    <form method="POST">
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">account_circle</i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">visibility_off</i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">email</i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">contact_phone</i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">perm_identity</i></span>
                            </div>
                            <!-- <input type="text" class="form-control" value="seller" name="userType" readonly> -->
                            <select id="category" name="type" style="width: 87%;">
                                <option value="seller">seller</option>
                                <option value="buyer">buyer</option>
                            </select>
                        </div>
                        <center>
                            <div class="form-check ">

                                <label class="form-check-label" for="checkBox"> <input type="checkbox" class="form-check-input" id="checkBox">I agree the <a href="">Terms and
                                        Conditions</a> </label>
                            </div>
                            <p class="lead">Do you have an account?<a data-bs-toggle="modal" data-bs-target="#login" class="login" data-bs-whatever="@mdo" href="" style="text-decoration:none;"> <b>Login</b></a></p>
                            <span><button type="submit" id="disabled" name="signup" class="btn btn-outline-success btn-lg btn-block" disabled>Sign Up</button>
                            </span>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------- SIGN UP AS BUYER ---------------- -->
    <!-- <div class="modal fade" id="signup-as-buyer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Sign Up</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="imgcontainer">
                        <img src="https://cdn2.iconfinder.com/data/icons/peppyicons/512/men_green-256.png" alt="Avatar" class="avatar">
                    </div>
                    <br>
                    <form method="POST">
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">account_circle</i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">visibility_off</i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">email</i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">contact_phone</i></span>
                            </div>
                            <input type="text" name="contactNumber" class="form-control" placeholder="Contact Number">
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons" style="font-size:35px;color:rgb(51, 196, 7)">perm_identity</i></span>
                            </div>
                            <input type="text" class="form-control" value="buyer" name="userType" readonly>
                        </div>
                        <center>
                            <span><button type="submit" id="signup" name="signup" class="btn btn-outline-success btn-lg btn-block">Sign Up</button>
                            </span>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <!--------------------------- LOG IN AS BUYER -------------------------->
    <div class="modal fade" id="login-as-buyer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Login</h4>
                    <button type="button" class="showModal btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" style="max-width:500px;margin:auto">
                       
                        <div class="imgcontainer">
                            <img src="https://cdn2.iconfinder.com/data/icons/peppyicons/512/men_green-256.png" alt="Avatar" class="avatar">
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
    <script src="./index.js"></script>

    <?php
    include './footer.php';
    ?>