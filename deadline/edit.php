<?php
//エスケープ処理
require_once '../util.php';
require_once '../DB.php';

require_once __DIR__ . '/../header.php';


//編集ボタンを押した要素の取得
$id = $_POST['id'];
$title = $_POST['title'];
$deadline = $_POST['deadline'];
$detail = $_POST['detail'];
$taglist = $_POST['tag'];
//締め切り一覧に戻るボタンの処理
if (isset($_POST['back'])) {
    header('Location: list.php');
}


?>
<!--ここから表示-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>締め切り編集画面</title>
</head>
<h1>締め切り編集画面</h1>
<main>
    <form method="POST" action="editcheck.php">
        <table>
            <tr>
                <td>題名</td>
                <td><input type="text" name="title" value=<?= h($title) ?> required></td>
            </tr>
            <tr>
                <td>締め切り日</td>
                <td><input type="date" name="deadline" value=<?= h($deadline) ?>required></td>
            </tr>
            <tr>
                <td>タグ</td>
                <td><input type="text" name="tag" value="<?= h($taglist) ?>"></td>
            </tr>
            <tr>
                <td>メモ</td>
                <td><textarea type="text" name="detail" cols="50" rows="5"><?= h($detail) ?></textarea></td>
            </tr>
            <input type="hidden" name="id" value=<?= h($id) ?>>
        </table>
        <input class="btn4" type='submit' value='送信' />
    </form>
    <form method="POST">
        <input class="btn4" type='submit' name='back' value='締め切り一覧に戻る'>
    </form>
</main>

<script src="../script.js"></script>