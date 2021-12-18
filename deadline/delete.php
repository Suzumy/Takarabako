<?php

require_once '../DB.php';
require_once '../util.php';

$apl_id = $_POST['id'];
$title = $_POST['title'];
$deadline = $_POST['deadline'];
$detail = $_POST['detail'];
if (isset($_POST['back'])) {
    header('Location: list.php');
}

$sql = "DELETE  FROM apl_tag WHERE apl_id =:apl_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':apl_id', $apl_id);
$stmt->execute();

$sql = "DELETE  FROM application_lists WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $apl_id);
$result = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>
<h1>締め切り削除確認画面</h1>
<p>この内容を削除しました</p>
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
<form method="POST">
    <input type='submit' name='back' value='締め切り一覧に戻る'>
</form>