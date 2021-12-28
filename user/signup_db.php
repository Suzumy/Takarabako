<?php
$username = $_POST['username'];
$pass = $_POST['password'];
$address = $_POST['address'];

session_start();

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


$sql = "INSERT INTO `users` (`id`, `username`,`meal`, `password`) VALUES (NULL, :username, :meal, :password )";
$sth = $pdo->prepare($sql);

$sth->bindValue(':username', $username);
$sth->bindValue(':meal', $address);
$sth->bindValue(':password', $pass);

$result = $sth->execute();

$register_user_id = $pdo->lastInsertId();

if ($result) {
    echo '登録成功！';
    $_SESSION['id'] = $register_user_id;
    $_SESSION['username'] = $username;
    header('Location: ../HP.php');
} else {
    echo '1,失敗';
}
