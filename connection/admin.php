<?php
session_start();
include 'storing_con.php';
$store = new Databases();

$id = $_SESSION['usedID'];
if ($id == "") {
  header('Location: ../index.php');
}

if (isset($_POST['block'])) {
  if ($_POST['curStat'] == 'inactive') {
    echo '<script>alert("Cant block! Account is already Inactive!")</script>';
  } else {
    if ($store->updateStat($_POST['sellerID'], 'inactive')) {
      echo '<script>alert("Status updated!")</script>';
    };
  }
}
if (isset($_POST['unblock'])) {
  if ($_POST['curStat'] == 'active') {
    echo '<script>alert("Account is already active!")</script>';
  } else {
    if ($store->updateStat($_POST['sellerID'], 'active')) {
      echo '<script>alert("Status updated!")</script>';
    };
  }
}

if(isset($_POST['decline'])){
  $store->decline($_POST['sellerID']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark ">
    <div class="container-fluid p-2">

      <a class="navbar-brand" href="#"><img src="../images/logo.png" alt="logo"><span>Admin Panel</span> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item" id="users">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="row content " style="max-width: 100%;">
    <div class="col-sm-2 ">
      <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right  text-success" id="sidebar-wrapper" style="position:fixed">
          <div class="sidebar-heading ">Admin</div>
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action  bg-dark text-light " id="dashbord">Dashboard</a>
            <?php
                    $_SESSION['count'] = 0;
                    $result = $store->notif();
                    if ($result == 0) {
                      $_SESSION['count'] = 0;
                    } else {
                      $_SESSION['count'] = $result;
                    }
                    ?>
            <a class="list-group-item list-group-item-action bg-dark text-light  border-secondary" id="Notification">Notification <span style="color: red;">(<?= $_SESSION['count']?>)</span> </a>
            <a class="list-group-item list-group-item-action bg-dark text-light  border-secondary" id="seller">Manage
              Seller</a>
            <a class="list-group-item list-group-item-action bg-dark text-light  border-secondary" id="buyer">View
              Buyers</a>
            <a class="list-group-item list-group-item-action bg-dark text-light  border-secondary"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-10" style="padding-top:30px;">
      <div id="page-content-wrapper">
        <div class="container-fluid dashbord" style="display: block;">
          <h1 class="display-4  ml-2">Dashboard</h1>
          <div class="container" style="padding-top:20px;">
            <div class="row">
              <div class="col-sm">
                <div class="card border-success mb-3" style="max-width: 18rem;">
                  <div class="card-header bg-success border-success text-white p-3">
                    <h5><i class="fa fa-users mr-2"></i>Buyer</h5>
                  </div>
                  <div class="card-body text-success">
                    <h5 class="card-title pt-3">Total Buyer</h5>
                    <?php
                    $_SESSION['count'] = 0;
                    $result = $store->Users('buyer');
                    if ($result == 0) {
                      $_SESSION['count'] = 0;
                    } else {
                      $_SESSION['count'] = $result;
                    }
                    ?>
                    <p class="display-4 pt-2 pb-3"><?= $_SESSION['count'] ?></p>
                  </div>

                </div>
              </div>
              <div class="col-sm">
                <div class="card border-primary mb-3" style="max-width: 18rem;">
                  <div class="card-header bg-primary border-primary text-white p-3">
                    <h5><i class="fa fa-users mr-2"></i>Seller</h5>
                  </div>
                  <div class="card-body text-primary">
                    <h5 class="card-title pt-3">Total Seller</h5>
                    <?php
                    $_SESSION['count'] = 0;
                    $result = $store->Users('seller');
                    if ($result == 0) {
                      $_SESSION['count'] = 0;
                    } else {
                      $_SESSION['count'] = $result;
                    }
                    ?>
                    <p class="display-4 pt-2 pb-3"><?= $_SESSION['count'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-sm">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                  <div class="card-header bg-info border-info text-white p-3">
                    <h5><i class="fa fa-industry mr-2"></i>Products</h5>
                  </div>
                  <div class="card-body text-info">
                    <h5 class="card-title pt-3">Total Products</h5>
                    <?php
                    $_SESSION['count'] = 0;
                    $result = $store->products();
                    if ($result == 0) {
                      $_SESSION['count'] = 0;
                    } else {
                      $_SESSION['count'] = $result;
                    }
                    ?>
                    <p class="display-4 pt-2 pb-3"><?= $_SESSION['count'] ?></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid notification" style="display: none;">
        <h1 class="mt-4"> Manage Seller Notifications</h1>
        <table class="table table-hover">
          <thead class="thead bg-success text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email Address</th>
              <th scope="col">Contact Number</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $res = $store->unaccept();
            foreach ($res as $seller) {
            ?>
              <form method="POST">
                <tr>
                  <input type="hidden" name="sellerID" value="<?= $seller['id'] ?>">
                  <input type="hidden" name="curStat" value="<?= $seller['status'] ?>">
                  <td scope="row"><?= $seller['id'] ?></td>
                  <td><?= $seller['username'] ?></td>
                  <td><?= $seller['email'] ?></td>
                  <td><?= $seller['contactNumber'] ?></td>
                  <td><?= $seller['status'] ?></td>
                  <td><button type="submit" class="btn btn-outline-success ml-1" name="unblock" id="accept">Accept</button>
                    <button type="submit" class="btn btn-outline-danger ml-1" name="decline" id="decline">Decline</button>
                  </td>
                </tr>
              </form>
            <?php } ?>
          </tbody>

        </table>
      </div>
      <div class="container-fluid seller" style="display: none;">
        <h1 class="mt-4">Manage Seller</h1>
        <table class="table table-hover">
          <thead class="thead bg-success text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email Address</th>
              <th scope="col">Contact Number</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $res = $store->sellers('seller');
            foreach ($res as $seller) {
            ?>
              <form method="POST">
                <tr>
                  <input type="hidden" name="sellerID" value="<?= $seller['id'] ?>">
                  <input type="hidden" name="curStat" value="<?= $seller['status'] ?>">
                  <td scope="row"><?= $seller['id'] ?></td>
                  <td><?= $seller['username'] ?></td>
                  <td><?= $seller['email'] ?></td>
                  <td><?= $seller['contactNumber'] ?></td>
                  <td><?= $seller['status'] ?></td>
                  <td><button type="submit" class="btn btn-outline-dark ml-1" name="block" id="block">Block</button>
                    <button type="submit" class="btn btn-outline-success ml-1" name="unblock" id="unblock">Unblock</button>
                  </td>
                </tr>
              </form>
            <?php } ?>
          </tbody>

        </table>
      </div>
      <div class="container-fluid buyer" style="display: none;">
        <h1 class="mt-4">View Buyers</h1>
        <table class="table table-hover">
          <thead class="thead bg-success text-white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email Address</th>
              <th scope="col">Contact Number</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $res = $store->sellers('buyer');
            foreach ($res as $seller) {
            ?>
            <form method="POST">
              <tr>
                <input type="hidden" name="sellerID" value="<?= $seller['id'] ?>">
                <input type="hidden" name="curStat" value="<?= $seller['status'] ?>">
                <td scope="row"><?= $seller['id'] ?></td>
                <td><?= $seller['username'] ?></td>
                <td><?= $seller['email'] ?></td>
                <td><?= $seller['contactNumber'] ?></td>
                <td><?= $seller['status'] ?></td>
                <td><button type="submit" class="btn btn-outline-dark ml-1" name="block" id="block">Block</button>
                  <button type="submit" class="btn btn-outline-success ml-1" name="unblock" id="unblock">Unblock</button>
                </td>
              </tr>
              </form>
            <?php } ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="../js/admin.js"></script>
</body>

</html>