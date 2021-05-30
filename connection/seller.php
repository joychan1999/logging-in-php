<?php
session_start();
include '../header.php';
include 'storing_con.php';
$store = new Databases();

$id = $_SESSION['usedID'];
// //fetch seller data
$sql = "SELECT * FROM users WHERE id = '$id'";
$row = $store->userDetails($sql);


?>
<link rel="stylesheet" href="../css/seller.css">
<div id="navigationBar">
    <ul class="nav">
        <li class="nav-item">
            <a href="#"><img class="logo" src="../images/logo.png" alt="logo" /></a>
        </li>
        <li class="nav-item">
            <h1 class="h1">
                Green <br /> Planthom
            </h1>
        </li>
    </ul>
    <div class="dropdown" style="float: right">
        <img class="dropbtn" src="https://cdn4.iconfinder.com/data/icons/web-design-and-development-6-4/128/279-256.png"
            alt="" />

        <div class="dropdown-content">
            <a data-bs-toggle="modal" data-bs-target="#personalInfo" data-bs-whatever="@mdo">Personal Profile</a>
            <a href="../index.php">Log Out</a>
        </div>
    </div>
</div>
<br /><br />

<!----------------------PERSONAL PROFILE---------------------------->
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
                            <img src="./images/joy.jpeg" class="rounded float-start" alt="profie" style="width: 100%;">
                        </div>
                        <div class="col-sm-6">
                            <p class="lead">Username</p>
                            <div class="input-group " style="margin-bottom:15px;">

                                <input type="text" class="edit-inputUser form-control w-50"
                                    value="<?= $row['username']; ?>" disabled>
                                <button class="btn-editUser btn btn-outline-primary" type="button">Edit</button>
                            </div>
                            <p class="lead">Password</p>
                            <div class="input-group" style="margin-bottom:15px;">
                                <input type="password" class="edit-inputPass form-control w-50"
                                    value="<?= $row['password']; ?>" disabled>
                                <button class="btn-editPass btn btn-outline-primary" type="button">Edit</button>
                            </div>
                            <p class="lead">Email Address</p>
                            <div class="input-group" style="margin-bottom:15px;">
                                <input type="text" class="edit-inputAdd form-control w-50" value="<?= $row['email']; ?>"
                                    disabled>
                                <button class="btn-editAdd btn btn-outline-primary" type="button">Edit</button>
                            </div>
                            <p class="lead">Contact Number</p>
                            <div class="input-group" style="margin-bottom:15px;">
                                <input type="text" class="edit-inputCon form-control w-50"
                                    value="<?= $row['contactNumber']; ?>" disabled>
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

<!-- -------------------TAB INFOS ----------------------->
<div class="tabInfos" style="margin-top: 20px;">
    <div class="tabset">
        <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked />
        <label for="tab1">My Products</label>
        <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier" />
        <label for="tab2">Orders</label>
        <input type="radio" name="tabset" id="tab3" aria-controls="dunkles" />
        <label for="tab3">Dunkles Bock</label>

        <div class="tab-panels">
            <!-- ----------------------------TAB 1 FOR TAB INFOS (MANIPULATE THE PRODUCTS)------------------------------------- -->
            <section id="marzen" class="tab-panel">
                <p class="ppup">
                    <a class="keyword" id="k1" href="./sellerside/addProduct.php" style="border-radius: 50%">
                        <img class="addIcon"
                            src="https://cdn1.iconfinder.com/data/icons/jetflat-multimedia-vol-4/90/0042_086_plus_add_increase-256.png"
                            alt="add" /></a><span>Add Product</span>
                </p>

                <!-- ---------------PRODUCT TABS----------------------->
                <br />
                <br />
                <div class="body">
                    <div class="container">
                        <input id="tab-1" type="radio" name="tabs" checked />
                        <label for="tab-1">Orchids</label>

                        <input id="tab-2" type="radio" name="tabs" />
                        <label for="tab-2">Daisies</label>

                        <input id="tab-3" type="radio" name="tabs" />
                        <label for="tab-3">Succulents</label>

                        <input id="tab-4" type="radio" name="tabs" />
                        <label for="tab-4">Roses</label>

                        <input id="tab-5" type="radio" name="tabs" />
                        <label for="tab-5">Others</label> <br><br>

                        <div class="content">
                            <!-- --------------------TAB 1 CONTENT --------------------------- -->
                            <div id="content-1">
                                <div class="row">
                                    <?php
                                    $products = $store->sellerProducts('Orchid', $id);
                                    foreach ($products as $item) {
                                        ?>
                                    <div class="column">
                                        <div class="card">
                                            <img src="<?= $item['image_url'] ?>" alt="<?= $item['name']?>" class="image"
                                                data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                                data-bs-whatever="@mdo" />
                                            <a data-bs-toggle="modal" data-bs-target="#<?= $item['name']?>"
                                                data-bs-whatever="@mdo" href="">
                                                <h2><?= $item['name'] ?></h2>
                                            </a>
                                            <p class="price">$<?= $item['price'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- --------------------TAB 2 CONTENT --------------------------- -->
                            <div id="content-2">
                                <div class="row">
                                    <?php
                                    $products = $store->sellerProducts('Daisy', $id);
                                    foreach ($products as $item) {
                                        ?>
                                    <div class="column">
                                        <div class="card">
                                            <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>"
                                                class="image" data-bs-toggle="modal"
                                                data-bs-target="#<?= $item['name'] ?>" data-bs-whatever="@mdo">
                                            <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                                data-bs-whatever="@mdo" href="">
                                                <h2><?= $item['name'] ?></h2>
                                            </a>
                                            <p class="price">$<?= $item['price'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }?>
                                </div>
                            </div>
                            <!-- --------------------TAB 3 CONTENT --------------------------- -->
                            <div id="content-3">
                                <div class="row">
                                    <?php
                                    $products = $store->sellerProducts('Succulent', $id);
                                    foreach ($products as $item) {
                                        ?>
                                    <div class="column">
                                        <div class="card">
                                            <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>"
                                                class="image" data-bs-toggle="modal"
                                                data-bs-target="#<?= $item['name'] ?>" data-bs-whatever="@mdo">
                                            <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                                data-bs-whatever="@mdo" href="">
                                                <h2><?= $item['name'] ?></h2>
                                            </a>
                                            <p class="price">$<?= $item['price'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }?>
                                </div>
                            </div>
                            <!-- --------------------TAB 4 CONTENT --------------------------- -->
                            <div id="content-4">
                                <div class="row">
                                    <?php
                                    $products = $store->sellerProducts('Rose', $id);
                                    foreach ($products as $item) {
                                        ?>
                                    <div class="column">
                                        <div class="card">
                                            <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>"
                                                class="image" data-bs-toggle="modal"
                                                data-bs-target="#<?= $item['name'] ?>" data-bs-whatever="@mdo">
                                            <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                                data-bs-whatever="@mdo" href="">
                                                <h2><?= $item['name'] ?></h2>
                                            </a>
                                            <p class="price">$<?= $item['price'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }?>
                                </div>
                            </div>
                            <!-- --------------------TAB 5 CONTENT --------------------------- -->
                            <div id="content-5">
                                <div class="row">
                                    <?php
                                    $products = $store->sellerProducts('Other', $id);
                                    foreach ($products as $item) {
                                        ?>
                                    <div class="column">
                                        <div class="card">
                                            <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>"
                                                class="image" data-bs-toggle="modal"
                                                data-bs-target="#<?= $item['name'] ?>" data-bs-whatever="@mdo">
                                            <a data-bs-toggle="modal" data-bs-target="#<?= $item['name'] ?>"
                                                data-bs-whatever="@mdo" href="">
                                                <h2><?= $item['name'] ?></h2>
                                            </a>
                                            <p class="price">$<?= $item['price'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ----------------------------TAB 2 FOR TAB INFOS (MANIPULATE THE ORDERS)------------------------------------- -->
            <section id="rauchbier" class="tab-panel">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div class="totalOrder">
                                <center>
                                    <h1>Total Orders</h1>
                                    <?php
                                    $id = $_SESSION['usedID'];
                                    $_SESSION['count'] = 0;
                                    $result = $store->countTotalTransaction($id);
                                    if ($result==0) {
                                    $_SESSION['count']= 0;
                                    }else{
                                    $_SESSION['count'] = $result;
                                    }
                                    ?>
                                    <h1><img src="https://cdn4.iconfinder.com/data/icons/green-shopper/200/chart2.png"
                                            alt="total icon" style="width: 60px;">
                                        <span><?=  $_SESSION['count']?></span>
                                    </h1>
                                </center>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="pending">
                                <center>
                                    <h1>Pending Orders</h1>
                                    <?php
                                    $id = $_SESSION['usedID'];
                                    $_SESSION['count'] = 0;
                                    $result = $store->countTransaction($id,'pending');
                                    if ($result==0) {
                                    $_SESSION['count']= 0;
                                    }else{
                                    $_SESSION['count'] = $result;
                                    }
                                    ?>
                                    <h1><img src="https://cdn2.iconfinder.com/data/icons/shipping-logistics-5/160/shipping-order-pending-256.png"
                                            alt="pending icon" style="width: 60px;">
                                        <span><?= $_SESSION['count']?></span>
                                    </h1>
                                </center>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="complete">
                                <center>
                                    <h1>Complete Orders</h1>
                                    <?php
                                    $id = $_SESSION['usedID'];
                                    $_SESSION['count'] = 0;
                                    $result = $store->countTransaction($id,'complete');
                                    if ($result==0) {
                                    $_SESSION['count']= 0;
                                    }else{
                                    $_SESSION['count'] = $result;
                                    }
                                    ?>
                                    <h1><img src="https://cdn0.iconfinder.com/data/icons/shopping-icons-part-1/512/shopping-12-256.png"
                                            alt="complete icon" style="width: 60px;">
                                        <span><?=  $_SESSION['count']?></span>
                                    </h1>
                                </center>
                            </div>
                        </div>
                    </div>

                    <br />
                    <br />
                    <h3>Orders</h3>
                    <table class=" table table-hover ">
                        <thead class="table-success ">
                            <tr>
                                <th scope="col ">Trans #</th>
                                <th scope="col ">Username</th>
                                <th scope="col ">Contact Number</th>
                                <th scope="col ">Product Name</th>
                                <th scope="col ">Price</th>
                                <th scope="col ">Quantity</th>
                                <th scope="col ">Total</th>
                                <th scope="col ">Status</th>
                                <th scope="col ">Date</th>
                                <th scope="col ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $id = $_SESSION['usedID'];
                                $result = $store->transactionOrders($id);
                                foreach ($result as $res) {
                                    $_SESSION['buyerID'] = $res['buyerID']; ?>
                            <tr>
                                <td><?= $res['primaryId']?></td>


                                <td>buyer name</td>
                                <td>buyer number</td>
                                <td><?= $res['productName']?></td>
                                <td><?= $res['productPrice']?></td>
                                <td><?= $res['productQuantity']?></td>
                                <td><?= $res['subtotal']?></td>
                                <td><?= $res['status']?></td>
                                <td><?= $res['timeStamp']?></td>
                                <td><button type="button" class="btn btn-outline-success" data-toggle="modal"
                                        data-target="#exampleModalCenter">Update Status</button>
                                </td>
                            </tr>
                            <?php
                                }?>
                        </tbody>
                    </table>

            </section>
        </div>
    </div>
</div>

<!-- --------------------PRODUCT INFORMATIONS ----------------------------- -->
<div class="modal fade" id="cattleya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container mb-5" style="background-color: white;">
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
                                    <img src="./images/sampleimageforcont/p1.jfif" class="smallpic"
                                        onclick="currentSlide(1)" />
                                    <img src="./images/sampleimageforcont/r1.jfif" class="smallpic"
                                        onclick="currentSlide(2)" />
                                    <img src="./images/sampleimageforcont/p2.jfif" class="smallpic"
                                        onclick="currentSlide(3)" />
                                    <img src="./images/sampleimageforcont/r2.jfif" class="smallpic"
                                        onclick="currentSlide(4)" />
                                    <img src="./images/sampleimageforcont/p3.jfif" class="smallpic"
                                        onclick="currentSlide(5)" />
                                </div>
                            </div>
                            <div class="col-6  mt-4">
                                <h3 class="text-center" style="font-weight: 300;"><b> Red African Rose</b></h3>
                                <h6 class="mt-5">Plant Description</h6>
                                <div style="margin-right: 5%;">
                                    <div class="mt-3 text-center">
                                        <p class="productContent">
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
                                    <br>
                                    <div class="mt-3" style="margin-left: 2%;">
                                        <span style="font-size: medium;">100 pieces available </span>
                                    </div><br>
                                    <div class="row">
                                        <div class="input-group" style="margin-right: 2%;margin-left: 3%;">
                                            <div class="col-auto">
                                                <a href="./relatedhtmlfiles/updateproduct.html"> <button type="button"
                                                        class="btn btn-success btn-md">
                                                        Update Details
                                                    </button></a>

                                                <button type="button" class="btn btn-danger btn-md">
                                                    Delete Product
                                                </button>
                                            </div>
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

<?php
include '../footer.php';
?>