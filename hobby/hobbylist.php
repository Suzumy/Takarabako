<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>趣味一覧画面</title>
</head>
<?php
//htmlspecialcharsの処理
require_once '../util.php';

//締め切り要素をlistDB.phpから取得
require_once 'hobbylistDB.php';

?>
<!-- ここからサイトの表示-->
<h1>趣味一覧 </h1>
<main>

    <form method='POST'>
        <select name='tag'>
            <option value='全て'>全て</option>
            <?php
            //絞り込みができていない
            //tagを取得 
            foreach ($tags as $tag) {
                $tags_list = "<option value='" . h($tags['tag']);
                $tags_list .= "'>" . h($tag['tag']) . "</option>";
                echo $tags_list;
            }
            ?>
        </select>
        <input type='submit' value='送信' />
    </form>
    <!-- ここから締め切りリスト-->
    <table border="1">
        <tr>
            <th>メモ</th>
            <th>日付</th>
            <th>タグ</th>
        </tr>

        <?php
        foreach ($tasks as $task) {
        ?>
            <tr>
                <td><?php echo h($task['memo']); ?></td>
                <td><?php echo h($task['day_at']); ?></td>
                <td><?php echo h($task['tag']); ?></td>
                <td>
                    <!-- 編集画面edit.phpにデータを送信-->
                    <!-- edit.phpをregister_Deadlineと共有にしたい -->
                    <form action="hobby_edit.php" method="POST">
                        <input type="hidden" name="id" value="<?= $task['id']; ?>">
                        <input type="hidden" name="memo" value="<?= $task['memo']; ?>">
                        <input type="hidden" name="day_at" value="<?= $task['day_at']; ?>">
                        <input type="hidden" name="tag" value="<?= $task['tag']; ?>">
                        <input type="hidden" name="URL" value="<?= $task['URL']; ?>">
                        <input type="submit" name="btn" value="編集">
                    </form>
                    <!-- 削除画面delete.phpにデータを送信-->
                    <form action="hobby_delete.php" method="POST">
                        <input type="hidden" name="title" value="<?= $task['memo']; ?>">
                        <input type="hidden" name="day_at" value="<?= $task['day_at']; ?>">
                        <input type="hidden" name="tag" value="<?= $task['tag']; ?>">
                        <input type="hidden" name="id" value="<?= $task['id']; ?>">
                        <input type="submit" name="btn" value="削除">
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
    //登録画面に遷移
    <a href=".php">登録</a>
</main>