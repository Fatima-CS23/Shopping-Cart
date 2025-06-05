<?php
session_start();
include 'products.php';

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Shopping-Cart</title>
    <link href="styling.css" rel="stylesheet">
  </head>
  <body>
<?php
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<div class="top-bar">
    <div class="site-title">My Home</div>
    <a href="cart.php" class="cart-link">🛒 View Cart (<?= $cartCount ?>)</a>
</div>

  <?php foreach ($products as $id => $product) { ?>
<?php } ?>
    <h1 style="color: #5D768B;">My Products</h1>
    <div class="product-grid">
        <?php foreach ($products as $id => $product): ?>
            <div class="product-card">
                <img src="<?= $product['product-image'] ?>" alt="">
                <h3><?= $product['product-name'] ?></h3>
                <p>PKR <?= number_format($product['product-price']) ?></p>
                <a href="?add=<?= $id ?>" class="btn">Add to Cart</a>
            </div>
        <?php endforeach; ?>
    </div>
  </body>
</html>
