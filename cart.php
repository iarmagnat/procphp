<?php

include_once 'helpers.php';

if (isset($_POST['sku'])) {
    if (!isset($_SESSION['cart'][$_POST['sku']])) {
        $_SESSION['cart'][$_POST['sku']] = 0;
    }

    if (!isset($_POST['replace'])) {
        $_SESSION['cart'][$_POST['sku']] += intval($_POST['quantity']);
    } else {
        $_SESSION['cart'][$_POST['sku']] = intval($_POST['quantity']);
    }

    if ($_SESSION['cart'][$_POST['sku']] === 0) {
        unset($_SESSION['cart'][$_POST['sku']]);
    }
}

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
include 'nav.php'
?>
<main>
<?php
if (count($_SESSION['cart']) !== 0) {
    ?>

    <?php
    if (isConnected()) {
        ?>
        <a href="/order.php">Validate your order</a>
        <?php
    } else {
        ?>
        <p>You need to <a href="/login.php">login</a> to continue your order.</p>
        <?php
    }
    ?>

    <table class="cart">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($_SESSION['cart'] as $sku => $quantity) {
            $product = loadProduct($sku);
            $total += $product['price'] / 100 * $quantity;
            cartLine($sku, $quantity, $product);
        }
        ?>
        <tr>
            <td></td>
            <td>Total</td>
            <td colspan="2"></td>
            <td><?= $total ?></td>
        </tr>
        </tbody>
    </table>

    <?php
} else {
    ?>
    <p>Your cart is empty...</p>
    <p>Return to the <a href="/">homepage</a>?</p>
    <?php
}
?>

</main>
</body>
</html>
