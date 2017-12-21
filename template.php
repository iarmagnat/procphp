<?php

function productTile($product)
{
    ?>
    <article class="tile">
        <h3><?= $product['name'] ?></h3>
        <img src="/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <b><?= $product['price'] / 100 ?></b>
        <p><?= $product['description'] ?></p>
        <form action="/cart.php" method="post">
            <input type="hidden" value="<?= $product['sku'] ?>" name="sku">
            <fieldset>
                <label for="qt-<?= $product['sku'] ?>">Quantity: </label>
                <select name="quantity" id="qt-<?= $product['sku'] ?>">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </fieldset>
            <input type="submit" value="Add to cart">
        </form>
    </article>
    <?php
}

function cartLine($sku, $quantity, $product)
{
    ?>
    <tr>
        <td>
            <img src="/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        </td>
        <td>
            <?= $product['name'] ?>
        </td>
        <td>
            <?= $quantity ?>
        </td>
        <td>
            <?= $product['price'] / 100 ?> $
        </td>
        <td>
            <?= $product['price'] / 100 * $quantity ?> $
        </td>
        <td>
            <form method="post">
                <input type="hidden" name="replace" value="true">
                <input type="hidden" name="sku" value="<?= $sku ?>">
                <input type="hidden" name="quantity" value="0">

                <input type="submit" value="X">
            </form>
        </td>
    </tr>
    <?php
}