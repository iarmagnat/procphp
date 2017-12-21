<nav>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <a href="/cart.php">Cart</a>
        </li>
        <?php
        if (isAdmin()) {
            ?>
            <li>
                <a href="/manage.php">Manage products</a>
            </li>
            <?php
        }
        ?>
        <?php
        if (!isConnected()) {
            ?>
            <li>
                <a href="/login.php">Login</a>
            </li>
            <?php
        } else {
            ?>
            <li>
                <a href="/logout.php">Logout</a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
