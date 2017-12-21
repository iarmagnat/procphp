<?php

session_start();

include_once 'template.php';

if (!isset($_SESSION['connected'])) {
    $_SESSION['user'] = '';
    $_SESSION['connected'] = false;
    $_SESSION['cart'] = [];
}

$GLOBALS['admins'] = ["admin", "morgan"];

function loginUser($login)
{
    $_SESSION['user'] = $login;
    $_SESSION['connected'] = true;
}

function logoutUser()
{
    $_SESSION['user'] = '';
    $_SESSION['connected'] = false;
}

function registerUser($login, $password)
{
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $users = json_decode(file_get_contents('users.json'), true);
    $users[$login] = $pass;
    file_put_contents('users.json', json_encode($users));
}

function isConnected()
{
    if ($_SESSION['connected']) {
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    if (isConnected() && in_array($_SESSION['user'], $GLOBALS['admins'])) {
        return true;
    } else {
        return false;
    }
}

function getProducts()
{
    $products = scandir('./products');
    $loaded = [];
    foreach ($products as $product) {
        $tmp = json_decode(file_get_contents('./products/' . $product), true);
        if ($tmp['active']) {
            $loaded[] = $tmp;
        }
    }
    return $loaded;
}