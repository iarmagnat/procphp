<?php

include_once 'helpers.php';

if (isset($_POST['login'])) {
    $users = json_decode(file_get_contents('users.json'), true);
    $login = $_POST['login'];
    $pass = $_POST['password'];
    if (isset($users[$login])) {
        if (password_verify($pass, $users[$login])) {
            loginUser($login);
            header('Location: /');
        } else {
            $msg = 'Your information seems to be incorrect';
        }
    } else {
        $msg = 'Your information seems to be incorrect';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to store</title>
</head>
<body>

<?php
include 'nav.php'
?>


<h1>Login</h1>

<?= (isset($msg)) ? $msg : '' ?>

<form method="post">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login!">
</form>

<p>You don't have an account? <a href="/register.php">Register?</a></p>

</body>
</html>
