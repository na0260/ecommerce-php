<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/Product.php';
require_once 'classes/Cart.php';

$products = Product::getAllProducts();
$cart = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    header('Location: checkout.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Link to CSS -->
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php foreach ($cart->items as $productId => $quantity): ?>
            <?php
            foreach ($products as $product) {
                if ($product->id == $productId) {
                    echo "<li>{$product->name} - Quantity: $quantity - Price: BDT " . ($product->price * $quantity) . "</li>";
                }
            }
            ?>
        <?php endforeach; ?>
    </ul>
    <p>Total: BDT <?php echo $cart->getTotal($products); ?></p>

    <form method="post">
        <button type="submit" name="checkout">Proceed to Checkout</button>
    </form>
    <a href="index.php">Continue Shopping</a>
</body>
</html>
