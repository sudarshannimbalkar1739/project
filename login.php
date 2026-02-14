<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // First get user by email only
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $row['password'])) {

            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit();

        } else {
            echo "<script>alert('Wrong Password');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }

    } else {
        echo "<script>alert('Email not found');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}
?>
