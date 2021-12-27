<?php
//DBへのアクセス
require_once __DIR__ . '/DB.php';
$sql = "SELECT  * FROM tags";
$stmt = $pdo->query($sql);
$stmt->execute();
$tags = $stmt->fetchall();

new PDO($dsn, $user, $password);
$sql = "SELECT * FROM hobbys";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$all = $stmt->fetchall();
$num = 0;
