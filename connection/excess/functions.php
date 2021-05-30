<?php
// include './connection/index1.php';
function check_login($con){
    // checking if user id exists
    if (isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = $id limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // redirect to log in
    header("Location: ./connection/index1.php");
    die;
}

function randomNum($length){
        $text = "";
        // to ensure the length of the rendom number is less than to 5
        if($length < 5)
        {
            $length = 5;
        }
        $len = rand(4, $length);

        for ($i=0; $i < $len; $i++) { 
            $text .= rand(0,9);
        }
        return $text;

}