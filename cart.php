<?php
session_start();
include 'products.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="styling.css" rel="stylesheet">
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty. <a href="catalogue.php">Go shopping</a></p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th><th>Qty</th><th>Price</th><th>Remove</th>
            </tr>
            <?php foreach ($cart as $id => $qty):
                $item = $products[$id];
                $subtotal = $item['product-price'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= $item['product-name'] ?></td>
                <td><?= $qty ?></td>
                <td>PKR <?= number_format($subtotal) ?></td>
                <td><a href="?remove=<?= $id ?>" class="btn danger">Remove</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h2>Total: PKR <?= number_format($total) ?></h2>
        <a href="catalogue.php" class="btn">Continue Shopping</a>
    <?php endif; ?>
    <div class="cart-actions">
        <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>
</div>

</body>
</html>
