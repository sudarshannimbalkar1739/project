<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Add to cart */
function addToCart($id, $name, $price)
{
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'qty' => 1
        ];
    }
}

/* Change quantity */
function changeQty($id, $type)
{
    if (!isset($_SESSION['cart'][$id])) return;

    if ($type === "plus") {
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id]['qty']--;
        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

/* Handle requests */
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'add') {
        addToCart($_GET['id'], $_GET['name'], $_GET['price']);
    }

    if ($_GET['action'] === 'qty') {
        changeQty($_GET['id'], $_GET['type']);
    }
}
