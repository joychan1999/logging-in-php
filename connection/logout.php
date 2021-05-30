<?php
session_start();


if(isset($_SESSION['usedID'])){
    unset($_SESSION['usedID']);
}
session_destroy();

header("Location: ../index.php");