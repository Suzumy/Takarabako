<?php
//エスケープ処理
require_once '../util.php';
//編集ボタンを押した要素の取得
$id = $_POST['id'];
$title = $_POST['title'];
$deadline = $_POST['deadline'];
$detail = $_POST['detail'];

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
                <td>タイトル <input type="text" name="title" value=<?= h($title) ?> required></td>
            </tr>
            <tr>
                <td>締切日<input type="text" name="deadline" value=<?= h($deadline) ?>required></td>
            </tr>
            <tr>
                <td>詳細<input type="text" name="detail" value=<?= h($detail) ?> required></td>
            </tr>
            <input type="hidden" name="id" value=<?= h($id) ?>>
        </table>
        <!--送信ボタン-->
        <input type='submit' value='送信' />
    </form>
    <!--締め切り一覧に戻るボタン-->
    <form method="POST">
        <input type='submit' name='back' value='締め切り一覧に戻る'>
    </form>
</main>