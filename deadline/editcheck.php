<?php

session_start();
//エスケープ処理
require_once '../util.php';
//DBに接続
require_once '../DB.php';

require_once __DIR__ . '/../header.php';


//締め切り一覧に戻るボタンの処理
if (isset($_POST['back'])) {
    header('Location: list.php');
}

//edit.phpからの変数
$id = $_POST['id'];
$title = $_POST['title'];
$deadline = $_POST['deadline'];
$tag = $_POST['tag'];
$old_tag = $tag; //削除するタグを格納している
$detail = $_POST['detail'];
$userId = $_SESSION['id']; //本来はセッション変数を使う
//update文
//$sql = "UPDATE application_lists SET  title ='" . $title . "', deadline ='" . $deadline . "', detail ='" . $detail . "' WHERE id ='" . $id . "'";
$sql = "UPDATE application_lists SET user_id = :user_id, title = :title, deadline = :deadline, detail = :detail WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':deadline', $deadline);
$stmt->bindValue(':detail', $detail);
$stmt->bindValue(':id', $id);
$stmt->execute();
$stmt->fetch();

//関係するapl_tagのカラムを削除
$delete_sql = "delete FROM apl_tag WHERE apl_tag.apl_id = :id";
$stmt = $pdo->prepare($delete_sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

//過去のタグデータを削除する
// $old_tag = explode(" ", $old_tag);
// foreach ($old_tag as $t) {
//     $delete_sql = "delete from tags where user_id = :user_id and tag = :tag";
//     $stmt = $pdo->prepare($delete_sql);
//     $stmt->bindValue(':user_id', $userId);
//     $stmt->bindValue(':tag', $t);
//     $stmt->execute();
// }

//変更後のタグを新規登録
$tag_id_array = array(); //arrayの初期化
$tag = explode(" ", $tag);
if (!empty($tag)) {
    foreach ($tag as $t) {
        if ($t == ' ') {
        } else {
            $sql = "insert into tags (tag, user_id) values (:tag, :user_id)";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':tag', $t, PDO::PARAM_STR);
            $sth->bindValue(':user_id', $userId, PDO::PARAM_STR);
            $result = $sth->execute();
            $last_tag_id = $pdo->lastInsertId();
            array_push($tag_id_array, $last_tag_id);
        }
    }

    //apl_tagを新規登録
    foreach ($tag_id_array as $t) {
        $sql = "insert into apl_tag (apl_id, tag_id) values(:apl_id, :tag_id)";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':apl_id', $id);
        $sth->bindValue(':tag_id', $t);
        $result = $sth->execute();
    }
}


?>
<!--ここから表示-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>
<h1>締め切り編集確認画面</h1>
<p>この内容で更新しました</p>
<p></p>
<table>
    <tr>
        <td>タイトル:<?= h($title) ?></td>
    </tr>
    <tr>
        <td>締切日:<?= h($deadline) ?></td>
    </tr>
    <tr>
        <td>詳細:<?= h($detail) ?></td>
    </tr>
</table>
<!--締め切り一覧に戻るボタン-->
<form method="POST">
    <input type='submit' name='back' value='締め切り一覧に戻る'>
</form>