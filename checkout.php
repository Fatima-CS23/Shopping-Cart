<?php
session_start();
include 'products.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Checkout</title>
    <link href="styling.css" rel="stylesheet">
  </head>
  <body>
    <h1>Checkout</h1>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty. <a href="catalogue.php" class="btn">Shop Now</a></p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($cart as $id => $qty):
                $item = $products[$id];
                $subtotal = $item['product-price'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= $item['product-name'] ?></td>
                <td><?= $qty ?></td>
                <td>PKR <?= number_format($item['product-price']) ?></td>
                <td>PKR <?= number_format($subtotal) ?></td>

            </tr>
            <?php endforeach; ?>
        </table>
        <h2>Total Payable: PKR <?= number_format($total) ?></h2>
        <p>Thank you for shopping with us!</p>
        <a href="index.php" class="btn">Return to Home</a>
        <form method="post" action="checkout.php">
          <button type="submit" name="confirm" class="confirm-btn">Confirm Order</button>
        </form>
        
    <?php endif; ?>

    <?php
    if (isset($_POST['confirm'])) {
        $_SESSION['cart'] = []; // Clear cart
        echo "<p style='color:green; font-weight:bold;'>Order Confirmed! Your items will be delivered soon.</p>";
    }
    ?>
  </body>
</html>
