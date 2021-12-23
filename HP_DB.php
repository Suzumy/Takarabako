<?php
//DBへのアクセス
require_once __DIR__ . '/DB.php';

$pdo = new PDO($dsn, $user, $password);
$sql = "SELECT * FROM hobbys";
$stmt = $pdo->query($sql);
$stmt->execute();
$all = $stmt->fetchall();
$num = 0;
?>