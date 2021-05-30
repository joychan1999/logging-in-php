<?php
session_start();
include '../../header.php';
include('../storing_con.php');
// require '../storing_con.php';

$store = new Databases();

if (isset($_POST['addButton'])) {
    $sellerID = $_SESSION['usedID'];
    if($store->addProduct($sellerID,$_POST['productname'],$_POST['category'],$_POST['productprice'],$_POST['description'],$_POST['productquantity'],$_POST['imageurl'])){
        echo "<script>alert('PRoduct added successfully!')</script>";
    }
} // end of adding product

?>

<link rel="stylesheet" href="../../css/addProduct.css">
<div class="addcontent">
    <a href="../seller.php">
        <img class="back" src="https://cdn0.iconfinder.com/data/icons/ie_Bright/128/back_green.png" alt="">
    </a>
    <h2 class="h2">Add Product</h2>

    <div class="container">
        <form method="post">
            <div class="row">
                <div class="col-25">
                    <label for="fname">Product Category</label>
                </div>
                <div class="col-75">
                    <select id="category" name="category">
                        <option value="Orchid">Orchid</option>
                        <option value="Daisy">Daisy</option>
                        <option value="Succulent">Succulent</option>
                        <option value="Rose">Rose</option>
                        <option value="Other">Others</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productname">Product Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productname" name="productname" placeholder="Product name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productprice"> Product Price</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productprice" name="productprice" placeholder="Place Price of the Product">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="productquantity"> Product Quantity</label>
                </div>
                <div class="col-75">
                    <input type="text" id="productquantity" name="productquantity" placeholder="Place Quantity of the Product">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="image">Place an image of the Product</label>
                </div>
                <div class="col-75">
                    <input type="text" id="imageurl1" name="imageurl" placeholder="Place URL of the Product">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="description">Add Description of the Product</label>
                </div>
                <div class="col-75">
                    <textarea id="description" name="description" placeholder="Write the product's description.." style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <button name="addButton" class="addButton">Add Product </button>
            </div>
        </form>
    </div>
</div>

<?php
include '../../footer.php';
?>