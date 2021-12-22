<?php
//エスケープ処理
require_once '../util.php';
//DBに接続
require_once '../DB.php';

//締め切り一覧に戻るボタンの処理
if (isset($_POST['back'])) {
    header('Location: list.php');
}

//edit.phpからの変数
$id = $_POST['id'];
$title = $_POST['title'];
$deadline = $_POST['deadline'];
$detail = $_POST['detail'];
//update文
$sql = "UPDATE application_lists SET  title ='" . $title . "', deadline ='" . $deadline . "', detail ='" . $detail . "' WHERE id ='" . $id . "'";
$stmt = $pdo->query($sql);
$stmt->execute();
$stmt->fetch();

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