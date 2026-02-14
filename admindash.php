<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css" />
</head>

<body id="home">
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="img/circleimg.png" alt="rotate-img" class="rotation-img" />
                <img src="img/logo.png" alt="logo" class="logo-img" />
                <h1>Foodies</h1>
            </div>
            <div class="mid">
                <span id="typing" class="typing"></span>
                <span id="cursor" class="cursor">|</span>
            </div>
            <nav id="navMenu">
                <a href="index.php">Home</a>
                <a href="#additem">add items</a>
                <a href="#showitems">items</a>
                <a href="#showusr">Show users info</a>
                
            </nav>
        </div>
    </header>

    <section id="additem">
        <h1>Add Items</h1>
        <div class="additem">
            <form action="admin.php" method="POST">
                <h1>Breakfast</h1>
                <input type="text" name="bname" placeholder="Item Name" required>
                <input type="text" name="bprice" placeholder="Price" required>
                <input type="text" name="bimage" placeholder="Enter http: url only" required>
                <button name="badd">Add Item</button>
            </form>
            <form action="admin.php" method="POST">
                <h1> dinner</h1>
                <input type="text" name="dname" placeholder="Item Name" required>
                <input type="text" name="dprice" placeholder="Price" required>
                <input type="text" name="dimage" placeholder="Enter http: url only" required>
                <button name="dadd">Add Item</button>
            </form>
            <form action="admin.php" method="POST">
                <h1>desserts</h1>
                <input type="text" name="dename" placeholder="Item Name" required>
                <input type="text" name="deprice" placeholder="Price" required>
                <input type="text" name="deimage" placeholder="Enter http: url only" required>
                <button name="deadd">Add Item</button>
            </form>
        </div>
    </section>
    <div class="partition autoshow" id="showitems">
        <img src=" img\separator.svg" alt="seperator">
        <h1>breakfast</h1>
        <img src="img\separator.svg" alt="seperator">
    </div>
    <section class="menu1">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM breakfast");
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card imgrevel">
                <img src="<?php echo $row['image']; ?>" />
                <h2><?php echo $row['item_name']; ?></h2>
                <div id="price" class="price">₹ <?php echo $row['price']; ?></div>

                <form action="delete.php" method="POST">
                    <input type="hidden" name="table_nm" value="breakfast">
                    <input type="hidden" name="col_nm" value="breakfast_id">
                    <input type="hidden" name="id" value="<?php echo $row['breakfast_id']; ?>">
                    <button name="submit" type="submit"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this item?')">
                        ❌ Delete
                    </button>
                </form>

            </div>
        <?php } ?>
    </section>
    <div class="partition autoshow">
        <img src="img\separator.svg" alt="seperator">
        <h1>Dinner</h1>
        <img src="img\separator.svg" alt="seperator">
    </div>
    <section class="menu1">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM dinner");
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card imgrevel">
                <img src="<?php echo $row['image']; ?>" />
                <h2><?php echo $row['item_name']; ?></h2>
                <div id="price" class="price">₹ <?php echo $row['price']; ?></div>

                <form action="delete.php" method="POST">
                    <input type="hidden" name="table_nm" value="dinner">
                    <input type="hidden" name="col_nm" value="dinner_id">
                    <input type="hidden" name="id" value="<?php echo $row['dinner_id']; ?>">
                    <button name="submit" type="submit"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this item?')">
                        ❌ Delete
                    </button>
                </form>
            </div>
        <?php } ?>
    </section>

    <div class="partition autoshow">
        <img src="img\separator.svg" alt="seperator">
        <h1>desserts</h1>
        <img src="img\separator.svg" alt="seperator">
    </div>
    <section class="menu1">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM desserts");
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card imgrevel">
                <img src="<?php echo $row['image']; ?>" />
                <h2><?php echo $row['item_name']; ?></h2>
                <div id="price" class="price">₹ <?php echo $row['price']; ?></div>

                <form action="delete.php" method="POST">
                    <input type="hidden" name="table_nm" value="desserts">
                    <input type="hidden" name="col_nm" value="desserts_id">
                    <input type="hidden" name="id" value="<?php echo $row['desserts_id']; ?>">
                    <button name="submit" type="submit"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this item?')">
                        ❌ Delete
                    </button>
                </form>
            </div>
        <?php } ?>
    </section>

    <div class="partition autoshow" id="showusr">
        <img src="img\separator.svg" alt="seperator">
        <h1>Users</h1>
        <img src="img\separator.svg" alt="seperator">
    </div>
    <section class="menu1" style="width: 300px;">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card imgrevel">
                <h1>Username:</h1>
                <h3><?php echo $row['username']; ?></h3>
                <h1>Phone:</h1>
                <h3><?php echo $row['phone']; ?></h3>
                <h1>Address:</h1>
                <h3><?php echo $row['address']; ?></h3>
                <h1>Email:</h1>
                <h3><?php echo $row['email']; ?></h3>
                <h1>Password:</h1>
                <h3><?php echo $row['password']; ?></h3>

                <form action="delete.php" method="POST">
                    <input type="hidden" name="table_nm" value="users">
                    <input type="hidden" name="col_nm" value="users_id">
                    <input type="hidden" name="id" value="<?php echo $row['users_id']; ?>">
                    <button name="submit" type="submit"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this item?')">
                        ❌ Delete
                    </button>
                </form>
            </div>
        <?php } ?>
    </section>


    <script src="js/admin.js"></script>
</body>

</html>