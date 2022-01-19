<?php
//DBへのアクセス
require_once __DIR__ . '/DB.php';

session_start();

$userId = $_SESSION['id']; //本来はセッションに入っているユーザーIDを参照する
$sql = "SELECT DISTINCT tag FROM  tags JOIN hobby_tag ON tags.id=hobby_tag.tag_id WHERE user_id = :user_id and tag != ' '";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->execute();
$tags = $stmt->fetchall();

//new PDO($dsn, $user, $password);
//tagが送られてるかチェック
if (empty($_POST['tag'])) {
    $sql = "SELECT * FROM hobbys WHERE user_id = :user_id ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId);
    $stmt->execute();
    $all = $stmt->fetchall();
    $num = 0;
} else {
    $tag = $_POST['tag'];
    //tagから表示する趣味を絞り込む処理
    $sql = 'SELECT * FROM tags WHERE tag=:tag';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tag', $tag);
    $stmt->execute();
    $tags_id = $stmt->fetch();
    $tags_id = $tags_id['id'];
    $sql = 'SELECT * FROM  hobbys JOIN hobby_tag ON hobbys.id=hobby_tag.hobby_id WHERE hobby_tag.tag_id=:tags_id and user_id = :user_id ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tags_id', $tags_id);
    $stmt->bindValue(':user_id', $userId);

    $stmt->execute();
    $all = $stmt->fetchall();
    $num = 0;
}


#締め切りの内一番締め切りが近いものをとってくる
$sql = "SELECT * FROM `application_lists` WHERE user_id = :user_id AND deadline > now() ORDER BY deadline LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->execute();
$near_deadline = $stmt->fetch();
if (empty($near_deadline[0])) {
    $near_deadline = 'false';
}
