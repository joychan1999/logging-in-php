<?php

class Databases
{
    public $con;

    public function __construct()
    {
        $this->con = mysqli_connect('remotemysql.com:3306', '7zvOC8LbBr', '7Fo3Yd8gWq', '7zvOC8LbBr');
        if (!$this->con) {
            echo 'Database Connection Error '.mysqli_connect_error($this->con);
        }
    }

    //end of construct function

    //fetching the products from the databse
    public function select($table_name, $cat)
    {
        $array = [];
        $query = 'SELECT * FROM '.$table_name." WHERE category='".$cat."'";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

    //end of select function (fetching the products from the database)

    //USER LOGIN
    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $query = $this->con->query($sql);
        // echo 'console.log('.$query.')';
        if ($query->num_rows > 0) {
            $row = $query->fetch_array();

            return $row;
        } else {
            return false;
        }
    }

    //end of login

    //USER SIGNUP
    public function signup($username, $password, $email, $contactNumber, $type, $status)
    {
        $sql = "INSERT INTO users(username, password,email,contactNumber,type,status) VALUES('".$username."','".$password."','".$email."','".$contactNumber."','".$type."','".$status."')";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }

        // echo 'console.log('.$query.')';
        // if ($query->num_rows > 0) {
        //     $row = $query->fetch_array();
        //     return $row;
        // } else {
        //     return false;
        // }
    }

    //end of login

    //FETCHING DATA OF EVERY USER
    public function userDetails($sql)
    {
        $query = $this->con->query($sql);
        $row = $query->fetch_array();

        return $row;
    }

    //end of user details function

    //ESCAPE
    public function escape_string($value)
    {
        return $this->con->real_escape_string($value);
    }

    //end of escape

    //ADD ITEM TO CART
    public function addToCart($userID, $sellerID, $productImage, $productQuantity, $productPrice, $subTotal, $productName)
    {
        $sql = "INSERT INTO cart(userID,sellerID, productImage,productQuantity,productPrice,subtotal,productName) VALUES('".$userID."','".$sellerID."','".$productImage."','".$productQuantity."','".$productPrice."','".$subTotal."','".$productName."')";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    // end of function add item to cart

    //COUNTING ITEMS IN CART PER USER
    public function countCart($id)
    {
        $total;
        $sql = "SELECT count(*) as total from cart where userID='".$id."'";
        $result = mysqli_query($this->con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['total'];
        }

        return $total;
    }

    //end of count function

    //FETCHING ITEMS IN THE CART PER USER
    public function getCartItems($id)
    {
        $array = [];
        $query = "SELECT * FROM cart WHERE userID = '".$id."'";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

    //end of getting items from the cart

    //GETTING THE SUM OF THE ITEMS INSIDE THE CART
    public function getTotal($id)
    {
        $total;
        $sql = "SELECT SUM(subtotal) as total from cart where userID='".$id."'";
        $result = mysqli_query($this->con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['total'];
        }

        return $total;
    }

    //end of getting total function

    //DELETE ITEM FROM THE CART
    public function delItem($userID, $itemID)
    {
        $sql = "DELETE FROM cart WHERE userID='".$userID."' AND orderID = '".$itemID."'";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    //end of delete function

    //PLACING ORDER
    public function placeOrder($orderID, $userID, $username, $contact, $sellerID, $productName, $productImage, $productQuantity, $productPrice, $subtotal, $status)
    {
        $sql = "INSERT INTO orders(orderID,buyerID,buyerName,contactNum,sellerID,productName, productImage,productQuantity,productPrice,subtotal,status) VALUES('".$orderID."','".$userID."','".$username."','".$contact."','".$sellerID."','".$productName."','".$productImage."','".$productQuantity."','".$productPrice."','".$subtotal."','".$status."')";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    //end of placing order function

    //DELETE ALL ITEM IN THE CART AFTER PLACING THE ORDER
    public function delItemsPlace($id)
    {
        $sql = "DELETE FROM cart WHERE userID='".$id."'";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    //end of delete function after place order

    //SHOWING THE ORDERS
    public function orders($id)
    {
        $array = [];
        $query = "SELECT * FROM orders WHERE buyerID = '".$id."'";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

    //nd of show order function

    //GETTING THE STATUS OF ITEM TO BE DELETED
    public function getStat($userID, $itemID)
    {
        $sql = "SELECT * FROM orders WHERE buyerID = '$userID' AND primaryId = '$itemID'";
        $query = $this->con->query($sql);
        // echo 'console.log('.$query.')';
        if ($query->num_rows > 0) {
            $row = $query->fetch_array();

            return $row;
        } else {
            return false;
        }
    }

    //DELETE ITEM FROM THE CART
    public function cancelOrder($userID, $itemID)
    {
        $sql = "DELETE FROM orders WHERE buyerID='".$userID."' AND primaryId = '".$itemID."'";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    //end of delete function

    //ADDING PRODUCT TO THE DATABASE
    public function addProduct($sellerID, $prodName, $cat, $prodPrice, $description, $stock, $img_url)
    {
        $sql = "INSERT INTO products(sellerID, name,category,price,description,stock,image_url) VALUES('".$sellerID."','".$prodName."','".$cat."','".$prodPrice."','".$description."','".$stock."','".$img_url."')";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }

    // end of adding product to the database

    //FETCHING PRODUCTS EVERY SELLER
    public function sellerProducts($cat, $sellerID)
    {
        $array = [];
        $query = "SELECT * FROM products WHERE category='".$cat."' AND sellerID = '".$sellerID."'";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

    //end of selectproduct function

    //FETCHING ORDERS IN THE SELLER
    public function transactionOrders($sellerID)
    {
        $array = [];
        $query = "SELECT * FROM orders WHERE sellerID='".$sellerID."'";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

    //GETTING THE USER INFO IN TRANSACTION
    public function userInfo($id)
    {
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $query = $this->con->query($sql);
        if ($query->num_rows > 0) {
            $row = $query->fetch_array();

            return $row;
        } else {
            return false;
        }
    }

    //end of user info function

    //COUNTING TRANSACTION IN SELLER
    public function countTransaction($id, $status)
    {
        $total;
        $sql = "SELECT count(*) as total from orders where sellerID='".$id."' AND status = '".$status."'";
        $result = mysqli_query($this->con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['total'];
        }

        return $total;
    }

    //COUNT TOTAL TRANSACTION
    public function countTotalTransaction($id)
    {
        $total;
        $sql = "SELECT count(*) as total from orders where sellerID='".$id."'";
        $result = mysqli_query($this->con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['total'];
        }

        return $total;
    }

    //end of count function

    //FETCHING PRODUCT INFORMATION
    public function prodInfo($id)
    {
        $sql = "SELECT * FROM products WHERE id = '$id'";
        $query = $this->con->query($sql);
        if ($query->num_rows > 0) {
            $row = $query->fetch_array();

            return $row;
        } else {
            return false;
        }
    }// end of product info function

    //DELETING PRODUCT
    public function del($userID, $itemID){
        $sql = "DELETE FROM products WHERE sellerID='".$userID."' AND id = '".$itemID."'";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        }
    }//end of delete function


    //UPDATING PRODUCT
    public function updatePro($prodID, $sellerID, $prodName, $prodPrice, $prodDes, $prodStock,$prodImage){
        $sql = "UPDATE products SET name='".$prodName."',price='".$prodPrice."', description='".$prodDes."', stock='".$prodStock."',image_url='".$prodImage."' WHERE sellerID='".$sellerID."' AND id = '".$prodID."'";
        $query = $this->con->query($sql);
        if ($query) {
            return $query;
        } else {
            echo $this->con->error;
        } 
    }
}
