<?php
include 'db.php';
if (!$conn) {
  echo "<script>alert('Database connection failed');</script>";
  exit;
}

$user_id  = $_SESSION['user_id'];
$cartData = $_POST['cartData'];

if (empty($cartData)) {
  echo "<script>alert('Cart is empty');window.location='index.php';</script>";
  exit;
}

$items = explode(",", $cartData);
$success = true;

foreach ($items as $item) {

  list($id, $name, $price, $qty) = explode("|", $item);

  $id   = mysqli_real_escape_string($conn, $id);
  $name = mysqli_real_escape_string($conn, $name);

  $sql = "INSERT INTO cart_items (user_id, food_id, food_name, price, quantity)
            VALUES ('$user_id', '$id', '$name', '$price', '$qty')";

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
