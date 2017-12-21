<?php

include_once 'helpers.php';

if (isset($_POST['toggle'])) {
    $sku = $_POST['toggle'];
    $product = loadProduct($sku);
    $product['active'] = ! $product['active'];
    saveProduct($sku, $product);
}

if (isset($_POST['name'])) {
    $product = [];
    $product['name'] = $_POST['name'];
    $product['description'] = $_POST['description'];
    $product['image'] = $_POST['image'];
    $product['price'] = intval(floatval($_POST['price']) * 100);
    createProduct($product);
}

$products = getProducts(false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store management</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
include 'nav.php'
?>

<h1>Edit and create products.</h1>

<form class="editor" method="post">
    <input type="text" name="name" placeholder="Product name">
    <textarea name="description" cols="30" rows="10" placeholder="description"></textarea>
    <input type="text" name="image" placeholder="image">
    <input type="text" name="price" placeholder="price">

    <input type="submit" value="Create/modify">
</form>

<div class="list-wrapper">
    <?php
    foreach ($products as $product) {
        ?>
        <div class="manage-block">
            <p><?= $product['name'] ?></p>
            <form method="get">
                <input type="hidden" values="<?= json_encode($product) ?>">
                <input type="submit" value="Edit">
            </form>
            <form method="post">
                <input type="hidden" value="<?= $product['sku'] ?>" name="toggle">
                <input type="submit" value="<?= ($product['active'] ? 'deactivate' : 'activate' ) ?>">
            </form>
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>
