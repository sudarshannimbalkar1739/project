
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


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

$check_breakfast = mysqli_query($conn, "SELECT * FROM breakfast LIMIT 1");

if (mysqli_num_rows($check_breakfast) == 0) {

    mysqli_query($conn, "
    INSERT INTO breakfast (item_name, price, image) VALUES
    ('Idli', 40, 'https://cdn.pixabay.com/photo/2017/06/16/11/38/breakfast-2408818_1280.jpg'),
    ('Dosa', 60, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQACh1yWbIwNiWJOZ-8lkt9oGkf5cdMK4DV8Q&s'),
    ('Upma', 50, 'https://t4.ftcdn.net/jpg/10/88/62/83/360_F_1088628359_6ZskzdYQNvfT1QICDXE0W9kpISi4kgS4.jpg')
    ");
}

/* DINNER table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS dinner (
    dinner_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) NOT NULL
)
");

$check_dinner = mysqli_query($conn, "SELECT * FROM dinner LIMIT 1");

if (mysqli_num_rows($check_dinner) == 0) {

    mysqli_query($conn, "
    INSERT INTO dinner (item_name, price, image) VALUES
    ('Paneer Butter Masala', 180, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGC028wkik4tveqN6bcM92CbfKLl3xfMJfmg&s'),
    ('Veg Biryani', 150, 'https://i.ytimg.com/vi/Do7ZdUodDdw/maxresdefault.jpg'),
    ('Roti Combo', 120, 'https://media.istockphoto.com/id/1150376593/photo/bread-tandoori-indian-cuisine.jpg?s=612x612&w=0&k=20&c=GGT5LN7G4zLhJTEnP_KcyvYuayi8f1nJcvQwvmj0rCM=')
    ");
}


/* DESSERTS table */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS desserts (
    desserts_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255) NOT NULL
)
");

$check_desserts = mysqli_query($conn, "SELECT * FROM desserts LIMIT 1");

if (mysqli_num_rows($check_desserts) == 0) {

    mysqli_query($conn, "
    INSERT INTO desserts (item_name, price, image) VALUES
    ('Gulab Jamun', 40, 'https://t4.ftcdn.net/jpg/10/17/65/75/360_F_1017657553_BFjfgC9jaR5KFxJKfQZxVySUnYZ211bR.jpg'),
    ('Ice Cream', 60, 'https://t4.ftcdn.net/jpg/08/45/19/79/360_F_845197906_IZjiHv2BJ7duGqAVoqL0f433RlKDxYUY.jpg'),
    ('Brownie', 80, 'https://recipesblob.oetker.in/assets/9a89b75f976642dcab8ae407e2f4344e/1272x764/chocolate-brownie.webp')
    ");
}


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