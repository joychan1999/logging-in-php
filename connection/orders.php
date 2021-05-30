<?php
    session_start();
    include 'storing_con.php';
    $store = new Databases();

    if(isset($_POST['cancel'])){
        $id = $_SESSION['usedID'];
        $res = $store->getStat($id,$_POST['id']);
        if($res['status'] == 'pending'){
            if($store->cancelOrder($id,$_POST['id'])){
                echo '<script>alert("Successfully cancelled the order")</script>';
            }
        }else{
            echo '<script>alert("You cannot cancel your order because it is already on-process!")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Document</title>
    <!----------------- -end of header---------------- -->
</head>
<style>
img {
    width: 120px;
}

.h1 {
    font-size: 20px;
    color: white;
    margin-left: 5px;
}

.main-container {
    margin-top: -50px;
}
</style>

<body>
    <div class="bg-success" id="navigationBar">
        <ul class="nav">
            <li class="nav-item">
                <a href="#"><img class="logo" src="../images/logo.png" alt="logo" style="width:60px" /></a>
            </li>
            <li class="nav-item">
                <h6 class="h1">
                    Green <br /> Planthom
                </h6>
            </li>
        </ul>
    </div>
    <br /><br />
    <div class="main-container">
        <!-- arrow back -->
        <a href="cart.php"><img src="https://cdn1.iconfinder.com/data/icons/image-manipulations/100/2-512.png" alt=""
                style="width:80px;"></a>
        <div style="float: right; margin-right: 10px; margin-top: 10px;">
            <a href="buyer.php" type="button" class="btn btn-outline-success"> Go Home</a>
        </div>

        <!-- shipping cart table -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-sm-12 container-fluid">
                    <div class="card" style="border:5px solid green">
                        <div class="card-body ">
                            <h5 class="card-title"><b>Orders</b></h5>
                            <p class="card-text">


                                <!-- showing data from the cart -->
                            <table class="table w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Date Ordered</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_SESSION['usedID'];
                                    // query of fetching data from the cart
                                    $products = $store->orders($id);
                                    foreach ($products as $row) {
                                        echo "<form action='' method='POST'>";
                                        echo "<input type='hidden' value='" . $row['primaryId'] . "' name='id' />";
                                        echo "<tr>";
                                        echo "<td> <img src=" . $row['productImage'] . "><br><center>" . $row['productName'] . " </center></td>";
                                        echo "<td>$" . $row['productPrice'] . "</td>";
                                        echo "<td>" . $row['productQuantity'] . "</td>";
                                        echo "<td>$" . $row['subtotal'] . "</td>";
                                        echo "<td>" . $row['timeStamp'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td><input type='submit' name='cancel' value='Cancel Order' class='btn btn-outline-danger' /></td>";
                                        echo "</tr>";
                                        echo "</form>";
                                    }?>

                                </tbody>
                            </table>


                            </p>

                        </div>
                    </div>
                </div>
                <!-- Container for checking out -->
                <!-- <div class="col-sm-3 container-fluid">
                    <div class="card ">
                        <form method="POST">
                            <div class="card-body bg-light">
                                <h2 class="card-title ">Order Detail</h2>
                                <p class="card-text">
                                <table class="table">
                                    <tbody>

                                        <?php
                                        $id = $_SESSION['usedID'];
                                        $result = $store->getTotal($id);
                                        if ($result) {
                                            $finalTotal = $result + 10;
                                        ?>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>
                                                <input type="text" name="subtotal" id="subtotal" class="form-control"
                                                    value='<?=$result?>' hidden> <b>$<?=$result?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Fee</td>
                                            <td>
                                                <input type="text" name="fee" id="fee" class="form-control" value='10'
                                                    hidden>
                                                <b>$10</b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <h6>Total</h6>
                                            </td>
                                            <td>
                                                <input type="text" name="total" id="total" class="form-control"
                                                    value='<?=$finalTotal?>' hidden> <b>$<?=$finalTotal?>
                                                </b>
                                            </td>
                                        </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                                </p>
                                <button class="btn btn-outline-success w-100" type="submit" id="checkout" class="submit"
                                    name="placeOrder" data-toggle="modal" data-target="#exampleModalCenter">Check
                                    Out</button>
                        </form>
                    </div>
                </div> -->
            </div>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>


</body>

</html>