<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "food_ordering";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("MySQL connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($conn, $sql)) {
    die("Database creation failed: " . mysqli_error($conn));
}

mysqli_select_db($conn, $dbname);

/* USERS table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS users (
    users_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

/* ADMIN table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS admin (
    users_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

/* BREAKFAST table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS breakfast (
    breakfast_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) NOT NULL
)
");

/* DINNER table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS dinner (
    dinner_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) NOT NULL
)
");

/* DESSERTS table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS desserts (
    desserts_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) NOT NULL
)
");

/* ORDERS table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    users_id INT NOT NULL,
    cart_data TEXT NOT NULL,
    total_price INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(users_id)
)
");
?>