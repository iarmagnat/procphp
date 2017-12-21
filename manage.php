<?php

include_once 'helpers.php';

$products = getProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store home</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
include 'nav.php'
?>

<h1>Welcome to the super store <?= (isConnected()) ? $_SESSION['user'] : '' ?>!</h1>

<form class="editor" method="post"></form>

<div class="list-wrapper">
    <?php
    foreach ($products as $product) {
        ?>

    <?php

    }
    ?>
</div>

</body>
</html>
