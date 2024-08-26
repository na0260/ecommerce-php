<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/Cart.php';

$cart = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : new Cart();
$cart->clearCart();
$_SESSION['cart'] = serialize($cart);
?>

<h1>Checkout Complete</h1>
<p>Thank you for your purchase!</p>
<a href="index.php">Return to Products</a>
