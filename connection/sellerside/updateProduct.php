<?php
session_start();
include '../../header.php';
include('../storing_con.php');
// require '../storing_con.php';

$store = new Databases();

$itemID = $_GET['id'];

if(isset($_POST['update'])){
    $sellerID = $_SESSION['usedID'];
    // $prodID, $sellerID, $prodName, $prodPrice, $prodDes, $prodStock,$prodImage
    if($store->updatePro($itemID,$sellerID,$_POST['productname'],$_POST['productprice'],$_POST['description'], $_POST['productquantity'],$_POST['imageurl'])){
        header('Location: ../seller.php');
    };
}
// if (isset($_POST['addButton'])) {
//     $sellerID = $_SESSION['usedID'];
//     if($store->addProduct($sellerID,$_POST['productname'],$_POST['category'],$_POST['productprice'],$_POST['description'],$_POST['productquantity'],$_POST['imageurl'])){
//         echo "<script>alert('PRoduct added successfully!')</script>";
//     }
// } // end of adding product

?>

<link rel="stylesheet" href="../../css/addProduct.css">
<div class="addcontent">
    <a href="../productInfo.php">
        <img class="back" src="https://cdn0.iconfinder.com/data/icons/ie_Bright/128/back_green.png" alt="">
    </a>
    <h2 class="h2">Add Product</h2>

    <div class="container">
        <form method="post">
            <div class="row">
                <div class="col-25">
                    <label for="productname">Update Product Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productname" name="productname" value="<?= $_SESSION['name']?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productprice">Update Product Price</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productprice" name="productprice" value="<?= $_SESSION['price']?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productquantity">Update Product Quantity</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productquantity" name="productquantity" value="<?= $_SESSION['stock']?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="image">Update image of the Product</label>
                </div>
                <div class="col-75">
                    <input type="text" id="imageurl1" name="imageurl" value="<?= $_SESSION['image']?>">

                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="description">Update Description of the Product</label>
                </div>
                <div class="col-75">
                    <textarea id="description" name="description"
                        style="height:200px"><?= $_SESSION['desription']?></textarea>
                </div>
            </div>
            <div class="row">
                <button name="update" class="btn btn-outline-success">Update Product </button>
            </div>
        </form>
    </div>
</div>

<?php
include '../../footer.php';
?>