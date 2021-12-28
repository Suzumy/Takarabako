<?php
//DBへのアクセス
require_once __DIR__ . '/DB.php';

$userId = 2; //本来はセッションに入っているユーザーIDを参照する
$sql = "SELECT  * FROM tags where user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->execute();
$tags = $stmt->fetchall();

new PDO($dsn, $user, $password);
$sql = "SELECT * FROM hobbys";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$all = $stmt->fetchall();
$num = 0;

#締め切りの内一番締め切りが近いものをとってくる
$sql = "SELECT * FROM `application_lists` WHERE deadline > now() ORDER BY deadline LIMIT 1";
$stmt = $pdo->query($sql);
$stmt->execute();
$near_deadline = $stmt->fetch();
