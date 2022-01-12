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

//締め切り一覧に戻るボタンの処理
if (isset($_POST['back'])) {
    header('Location: list.php');
}

//タグを取得する
$sql = "SELECT tag FROM application_lists LEFT JOIN apl_tag ON application_lists.id = apl_tag.apl_id LEFT JOIN tags ON apl_tag.tag_id = tags.id WHERE application_lists.id = :id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$tags = $stmt->fetchAll();
$tag = "";
foreach ($tags as $t) {
    $tag = $tag . $t['tag'] . ' ';
}
//最後に余分な空白ができるためこれを削除する
$tag = trim($tag);

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
                <td><input type="text" name="tag" value="<?= h($tag) ?>"></td>
            </tr>
            <tr>
                <td>メモ</td>
                <td><textarea type="text" name="detail" cols="50" rows="5"><?= h($detail) ?></textarea></td>
            </tr>
            <input type="hidden" name="id" value=<?= h($id) ?>>
        </table>
        <input type='submit' value='送信' />
    </form>
    <form method="POST">
        <input type='submit' name='back' value='締め切り一覧に戻る'>
    </form>
</main>

<script src="../script.js"></script>