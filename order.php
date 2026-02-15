<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if (!isset($_SESSION['users_id'])) {
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

if (empty($cartData)) {
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
    echo "<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #1d5642;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }
    h2 {
        color: #8a5454;
    }
    .dropdown {
    border: none;
    border-radius: 30px;
    font-size: 25px;
    background-color: #86144d77;
    position: relative;
    display: inline-block;
    }
    .textarea {
    margin-top: 15px;
    color: rgb(0, 0, 0);
    height: 70px;
    width: 70%;
    background-color: #ffacacdc;
    border: none;
    border-radius: 15px;
    }
    button {
    padding: 20px;
    margin-top: 20px;
    font-size: 20px;
    color: rgb(240, 240, 240);
    background-color: #501717dc;
    border: none;
    border-radius: 50px;
    z-index: 3;
          </style>";
    echo "<h2>Give Your Feedback</h2>";

    echo "<form action='feedback.php' method='POST'>";

    echo "<select name='rating' class='dropdown' required>";

    echo "<option value=''>Select Rating</option>";
    echo "<option value='5'>⭐⭐⭐⭐⭐</option>";
    echo "<option value='4'>⭐⭐⭐⭐</option>";
    echo "<option value='3'>⭐⭐⭐</option>";
    echo "<option value='2'>⭐⭐</option>";
    echo "<option value='1'>⭐</option>";
    echo "</select>";
    echo "<br><br>";

    echo "Message:<br>";
    echo "<textarea name='message' class='textarea' rows='5' cols='40' required></textarea>";
    echo "<br><br>";

    echo "<button type='submit'>Submit Feedback</button>";
    echo "<script>alert('Order placed successfully');</script>";
    echo "</form>";
} else {
    echo "<script>alert('Error placing order');window.location='index.php';</script>";
}
