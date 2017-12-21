<?php

include_once 'helpers.php';

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];
    if (strlen($pass) > 8) {
        registerUser($login, $pass);
        loginUser($login);
        header('Location: /');
    } else {
        $msg = 'Please choose a password longer than 8 characters';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>

<?php
include 'nav.php'
?>

<main>

    <h1>Register?</h1>

    <?= (isset($msg)) ? $msg : '' ?>

    <form method="post">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Register!">
    </form>

</main>
</body>
</html>

