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

function loadProduct($sku)
{
    return json_decode(file_get_contents('./products/' . $sku . '.json'), true);
}

function saveProduct($sku, $product)
{
    file_put_contents('./products/' . $sku . '.json', json_encode($product));
}

function modifyProduct($sku, $product)
{
    $old = loadProduct($sku);
    $product = $product + $old;
    file_put_contents('./products/' . $sku . '.json', json_encode($product));
}

function getProducts($onlyActive = true)
{
    $products = scandir('./products');
    $loaded = [];
    foreach ($products as $product) {
        if (is_file('./products/' . $product)) {
            $tmp = json_decode(file_get_contents('./products/' . $product), true);
            if ($tmp['active'] || !$onlyActive) {
                $loaded[] = $tmp;
            }
        }
    }
    return $loaded;
}

function createProduct($product)
{
    $sku = count(scandir('./products')) - 1;
    $product['sku'] = $sku;
    $product['active'] = false;
    saveProduct($sku, $product);
}