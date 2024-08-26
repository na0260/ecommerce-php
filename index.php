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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $cart->addProduct($_POST['product_id'], 1);
    $_SESSION['cart'] = serialize($cart);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- Link to CSS -->
</head>
<body>
<h1>Products</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <h2><?php echo $product->name; ?></h2>
            <p><?php echo $product->description; ?></p>
            <p>Price: BDT <?php echo $product->price; ?></p>
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<a href="cart.php">View Cart</a>
<a href="logout.php">Logout</a>
</body>
</html>
