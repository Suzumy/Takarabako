<?php
//削除処理

require_once '../DB.php';
require_once '../util.php';
require_once __DIR__ . '/../header.php';

$id = $_POST['id'];
$day_at = $_POST['day_at'];
$tag = $_POST['tag'];
$memo = $_POST['memo'];
$URL = $_POST['URL'];
if (isset($_POST['back'])) {
    header('Location: hobbylist.php');
}


$sql = "DELETE  FROM hobby_tag WHERE hobby_id =:hobby_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':hobby_id', $id);
$stmt->execute();

$sql = "DELETE  FROM hobbys WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$result = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>
<h1>趣味削除確認画面</h1>
<p>この内容を削除しました</p>
<table>
    <tr>
        <td>URL:<?= h($URL) ?></td>
    </tr>
    <tr>
        <td>タグ:<?= h($tag) ?></td>
    </tr>
    <tr>
        <td>メモ:<?= h($memo) ?></td>
    </tr>
</table>
<form method="POST">
    <input type='submit' name='back' value='趣味一覧に戻る'>
</form>