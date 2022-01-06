<?php
//DB接続設定
$dsn = 'mysql:host=localhost;dbname=takarabako;charset=utf8';
$user = 'treasure';
$password = 'box';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    echo 'Error' . $e->getMessage();
    die();
}

