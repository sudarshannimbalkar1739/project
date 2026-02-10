<?php
include "db.php";

if (isset($_POST['register'])) {
  if ($_POST['registerPassword'] !== $_POST['reenterregisterPassword']) {
    echo "<script>alert('Password Not Matched');</script>";
    exit;
  }
  else {
    $pass = ($_POST['registerPassword']);
    mysqli_query($conn, "INSERT INTO users(username,phone,address,email,password)
  VALUES(
    '{$_POST['username']}',
    '{$_POST['phone']}',
    '{$_POST['address']}',
    '{$_POST['email']}',
    '$pass'
  )");
    echo "<script>alert('Registration Successful');window.location='index.php';</script>";
  }
}
