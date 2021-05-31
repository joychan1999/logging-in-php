<?php
session_start();
include 'header.php';
include './connection/storing_con.php';
$store = new Databases();

$itemId = $_GET['sellerID'];
$_SESSION['sellerID'] = $_GET['sellerID'];

$itemId = $_GET['id'];
$result = $store->prodInfo($itemId);
$_SESSION['image'] = $result['image_url'];
$_SESSION['name'] = $result['name'];
$_SESSION['desription'] = $result['description'];
$_SESSION['price'] = $result['price'];
$_SESSION['stock'] = $result['stock'];


// if (isset($_POST['addnew'])) {
//     $itemId = $_GET['id'];
//     $sql = "SELECT * FROM products WHERE id = '$itemId'";
//     $row = $store->userDetails($sql);
//     $stock = $row['stock'];

//     if($_POST['quantity'] <= 0){
//         echo '<script>alert("Please specify the quantity!")</script>';
//     }else if($_POST['quantity'] > $stock){
//         echo '<script>alert("Not enough stock!")</script>';
//     }else{
//         $id = $_SESSION['usedID'];
//         $subtotal = $_POST['quantity'] * $_POST['price'];
//         $cartItems = $store->addToCart($id, $_POST['sellerID'], $_POST['image'], $_POST['quantity'], $_POST['price'], $subtotal, $_POST['name']);
//         if ($cartItems) {
//             echo '<script>alert("Item added to cart successfully!")</script>';
//         } else {
//             echo '<script>alert("FAiled")</script>';
//         }
//     }
// }

                                  
?>


<body>
    <div class="bg-success" id="navigationBar">
        <ul class="nav">
            <li class="nav-item">
                <a href="seller.php"><img class="logo" src="./images/logo.png" alt="logo" style="width:60px" /></a>
            </li>
            <li class="nav-item">
                <h6 style="font-size: 20px; color: white;">
                    Green <br /> Planthom
                </h6>
            </li>
        </ul>
    </div>
    <a href="index.php"><img src="https://cdn1.iconfinder.com/data/icons/image-manipulations/100/2-512.png" alt=""
            style="width:70px;"></a>
    <div class="container" style="margin-top: -40px;">
        <div class="row">
            <div class="col">
                <div class="container mt-5">
                    <img src="<?= $_SESSION['image']?>" alt="" style="width: 400px"> <br><br>
                    <h2 class="text-center" style="font-weight: 300;"><b> <?= $_SESSION['name']; ?></b></h2>
                </div>
            </div>
            <div class="col">
                <div>
                    </h3>
                    <h6 class="mt-5">Plant Description</h6>
                    <div style="margin-right: 2%;">
                        <div class="mt-3 text-center">
                            <p class="productContent" style="text-align:justify;">
                                <?= $_SESSION['desription']; ?>
                            </p>
                        </div>
                        <div class="mt-5" style="margin-left: 2%;">
                            <span><b>Price: &nbsp;</b>$<?= $_SESSION['price']; ?>/pot</span>
                        </div>
                        <br>
                        <div class="mt-3" style="margin-left: 2%;">
                            <span style="font-size: medium;"><b>Stock:
                                    &nbsp;</b><?= $_SESSION['stock']; ?> pieces available
                            </span>
                        </div><br>
                        <div class="row">
                            <div class="input-group" style="margin-right: 2%;margin-left: 3%;">
                                <div class="col-auto">
                                    <form method="POST">
                                        <input type="text" name="id" value="<?= $prod['id']; ?>" hidden>
                                        <input type="text" name="sellerID" value="<?= $_SESSION['sellerID']; ?>" hidden>
                                        <input type="text" name="image" value="<?= $_SESSION['image']; ?>" hidden>
                                        <input type="text" name="name" value="<?=$_SESSION['name']; ?>" hidden>
                                        <input type="text" name="price" value="<?=  $_SESSION['price']; ?>" hidden>
                                        <b> Quantity:</b> &nbsp;&nbsp;<input type="number" name="quantity"
                                            style="width: 35px" value="0">
                                        <br><br>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-success btn-lg" disabled>
                                                Add to Cart
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <p class="text-justify " style="font-size:15px;text-align:justify;">
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
</body>