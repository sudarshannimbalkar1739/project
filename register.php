<?php
session_start();
include "db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['registerPassword'];
$phone = $_POST['phone'];
$address = $_POST['address'];


if (isset($_POST['register'])) {
  if ($_POST['registerPassword'] !== $_POST['reenterregisterPassword']) {
    echo "<script>alert('Password Not Matched');window.location='index.php';</script>";
    exit;
  } else {
    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
      echo "<script>alert('Email already exists');</script>";
      die("<script>location='index.php';</script>");
    }
    $pass = ($_POST['registerPassword']);
    mysqli_query($conn, "INSERT INTO users(username,phone,address,email,password)
  VALUES(
    '$username',
    '$phone',
    '$address',
    '$email',
    '$pass'
  )");
    echo "<script>alert('Registration Successful');window.location='index.php';</script>";
  }
}
