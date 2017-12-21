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

<?php
if (count($_SESSION['cart']) !== 0) {
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
            cartLine($sku, $quantity);
        }
        ?>
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


</body>
</html>
