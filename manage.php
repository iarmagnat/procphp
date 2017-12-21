<?php

include_once 'helpers.php';

if (!isAdmin()) {
    header('Location: /');
}

$msg = '';

if (isset($_POST['toggle'])) {
    $sku = $_POST['toggle'];
    $product = loadProduct($sku);
    $product['active'] = !$product['active'];
    saveProduct($sku, $product);
}

if (isset($_POST['name'])) {
    $product = [];
    $product['name'] = $_POST['name'];
    $product['description'] = $_POST['description'];
    $product['image'] = $_POST['image'];
    $product['price'] = intval(floatval($_POST['price']) * 100);
    if (isset($_POST['sku'])) {
        modifyProduct($_POST['sku'], $product);
        $msg = 'Product modified';
    } else {
        createProduct($product);
        $msg = 'Product created';
    }
}

$editProduct = false;

if (isset($_GET['sku'])) {
    $editProduct = true;
    $product = loadProduct($_GET['sku']);
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

<?= $msg ?>

<form class="editor" method="post" action="manage.php">
    <input type="text" name="name" placeholder="Product name" value="<?= ($editProduct) ? $product['name'] : '' ?>">
    <textarea name="description" cols="30" rows="10"
              placeholder="description"><?= ($editProduct) ? $product['description'] : '' ?></textarea>
    <input type="text" name="image" placeholder="image" value="<?= ($editProduct) ? $product['image'] : '' ?>">
    <input type="text" name="price" placeholder="price" value="<?= ($editProduct) ? $product['price'] / 100 : '' ?>">

    <?php
    if ($editProduct) {
        ?>
        <input type="hidden" name="sku" value="<?= $product['sku'] ?>">
        <?php
    }
    ?>

    <input type="submit" value="<?= ($editProduct) ? 'Modify' : 'Create' ?>">
</form>

<div class="list-wrapper">
    <?php
    foreach ($products as $product) {
        ?>
        <div class="manage-block">
            <p><?= $product['name'] ?></p>
            <form method="get">
                <input type="hidden" name="sku" value="<?= $product['sku'] ?>">
                <input type="submit" value="Edit">
            </form>
            <form method="post">
                <input type="hidden" value="<?= $product['sku'] ?>" name="toggle">
                <input type="submit" value="<?= ($product['active'] ? 'deactivate' : 'activate') ?>">
            </form>
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>
