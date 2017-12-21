<?php

include_once 'helpers.php';

$orderId = order();

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

<h1>Thank you for your order!!</h1>

<p>Your order number is <?= $orderId ?></p>


</body>
</html>
