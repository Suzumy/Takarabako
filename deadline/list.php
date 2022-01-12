<?php
require_once __DIR__ . '/../header.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>趣味一覧画面</title>

    <link rel="stylesheet" href="HP.css">

</head>
<?php
//htmlspecialcharsの処理
require_once '../util.php';

//ホップアップの表示
require_once 'hopup.php';

//締め切り要素をlistDB.phpから取得
require_once 'listDB.php';

?>
<!-- ここからサイトの表示-->

<main>

    <h1 class="font">締め切り一覧 </h1>

    <div class="example">
        <form class="form" method='POST'>
            <select class="styled-select" name='tag'>
                <option value='全て'>全て</option>
                <?php
                //tagを取得 
                foreach ($tags as $tags) {
                    $tags_list = "<option value='" . h($tags['tag']);
                    $tags_list .= "'>" . h($tags['tag']) . "</option>";
                    echo $tags_list;
                }
                ?>
            </select>
            <input type='submit' value='送信' />
        </form>
        <!-- ここから締め切りリスト-->
        <table border="1">
            <tr>
                <th>タイトル</th>
                <th>締切日</th>
                <th>詳細</th>
            </tr>

            <?php
            foreach ($tasks as $task) {
            ?>
                <tr>
                    <td><?php echo h($task['title']); ?></td>
                    <td><?php echo h($task['deadline']); ?></td>
                    <td><?php echo h($task['detail']); ?></td>
                    <td>
                        <!-- 編集画面edit.phpにデータを送信-->
                        <!-- edit.phpをregister_Deadlineと共有にしたい -->
                        <form action="edit.php" method="POST">
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                            <input type="hidden" name="title" value="<?= $task['title']; ?>">
                            <input type="hidden" name="detail" value="<?= $task['detail']; ?>">
                            <input type="hidden" name="deadline" value="<?= $task['deadline']; ?>">
                            <input type="submit" name="btn" value="編集">
                        </form>
                        <!-- 削除画面delete.phpにデータを送信-->
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="title" value="<?= $task['title']; ?>">
                            <input type="hidden" name="detail" value="<?= $task['detail']; ?>">
                            <input type="hidden" name="deadline" value="<?= $task['deadline']; ?>">
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                            <input type="submit" name="btn" value="削除">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
    <div class="parent">
        <a class="btn3" href="register_Deadline.php">新規登録</a>
    </div>
</main>

<script src="../script.js"></script>