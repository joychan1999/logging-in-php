<?php
session_start();
include '../header.php';
include 'storing_con.php';
$store = new Databases();
$itemId = $_GET['id'];

$result = $store->prodInfo($itemId);
$_SESSION['image'] = $result['image_url'];
$_SESSION['name'] = $result['name'];
$_SESSION['desription'] = $result['description'];
$_SESSION['price'] = $result['price'];
$_SESSION['stock'] = $result['stock'];

if(isset($_POST['delete'])){
    // echo '<script>alert("Successfully placed the order")</script>';
    $id = $_SESSION['usedID'];
    if($store->del($id,$itemId)){
        header('Location: seller.php');
    };
    
}
                                       
?>

<body>
    <div class="bg-success" id="navigationBar">
        <ul class="nav">
            <li class="nav-item">
                <a href="seller.php"><img class="logo" src="../images/logo.png" alt="logo" style="width:60px" /></a>
            </li>
            <li class="nav-item">
                <h6 style="font-size: 20px; color: white;">
                    Green <br /> Planthom
                </h6>
            </li>
        </ul>
    </div>
    <a href="seller.php"><img src="https://cdn1.iconfinder.com/data/icons/image-manipulations/100/2-512.png" alt=""
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
                                        <a href="./sellerside/updateProduct.php?id=<?= $itemId?>">
                                            <button type="button" class="btn btn-success btn-md">
                                                Update Details
                                            </button>
                                        </a>

                                        <input type="submit" class="btn btn-danger btn-md" name="delete" value="Delete Product">

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