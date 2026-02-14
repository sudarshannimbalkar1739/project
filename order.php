<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if(!isset($_SESSION['users_id'])){
    die("Please login first");
}

$user_id = $_SESSION['users_id'];

/* Get user details */
$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE users_id='$user_id'");
$user = mysqli_fetch_assoc($userQuery);

$username = $user['username'];
$email    = $user['email'];
$phone    = $user['phone'];
$address  = $user['address'];

$cartData = $_POST['cartData'];

if(empty($cartData)){
    die("Cart is empty");
}

$items = explode(",", $cartData);
$success = true;

foreach ($items as $item) {

    list($id, $name, $price, $qty) = explode("|", $item);

    $sql = "INSERT INTO orders 
            (users_id, username, email, phone, address, food_id, food_name, price, quantity)
            VALUES 
            ('$user_id', '$username', '$email', '$phone', '$address',
             '$id', '$name', '$price', '$qty')";

    if (!mysqli_query($conn, $sql)) {
        $success = false;
        break;
    }
}

if ($success) {
    echo "<script>alert('Order placed successfully');window.location='index.php';</script>";
} else {
    echo "<script>alert('Error placing order');window.location='index.php';</script>";
}
?>
