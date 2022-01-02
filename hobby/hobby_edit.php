<?php
//エスケープ処理
require_once '../util.php';

require_once __DIR__ . '/../header.php';
//編集ボタンを押した要素の取得
$id = $_POST['id'];
$day_at = $_POST['day_at'];
$hobby_tag = $_POST['tag'];
$memo = $_POST['memo'];
$URL = $_POST['URL'];

if (isset($_POST['back'])) {
    header('Location: hobbylist.php');
}

?>
<!--ここから表示-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>趣味編集画面</title>
</head>
<h1>登録編集画面</h1>
<main>
    <form method="POST" action="hobby_editcheck.php">
        <table>
            <tr>
                //元のURLを比較用に表示する
                <td> URL <input type="text" name="URL" value=<?= h($URL) ?> required></td>
            </tr>
            <tr>
                <td>タグ<input type="text" name="hobby_tag" value=<?= h($hobby_tag) ?> required></td>
            </tr>
            <tr>
                <td>メモ<input type="text" name="memo" value=<?= h($memo) ?> required></td>
            </tr>
            <input type="hidden" name="id" value=<?= h($id) ?>>
        </table>
        <!--送信ボタン-->
        <input type='submit' value='送信' />
    </form>
    <!--締め切り一覧に戻るボタン-->
    <form method="POST" action="hobby_editcheck.php">
        <input type='submit' name='back' value='締め切り一覧に戻る'>
    </form>
</main>

<script src="../script.js"></script>