<?php

session_start();
//エスケープ処理
require_once '../util.php';
//DBに接続
require_once '../DB.php';

require_once __DIR__ . '/../header.php';

if (isset($_POST['back'])) {
    header('Location: hobbylist.php');
}


$id = $_POST['id'];
$URL = $_POST['URL'];
$tag_list = $_POST['hobby_tag'];
$memo = $_POST['memo'];
$userId = $_SESSION['id'];
//update文
//$sql = "UPDATE application_lists SET  title ='" . $title . "', deadline ='" . $deadline . "', detail ='" . $detail . "' WHERE id ='" . $id . "'";
$sql = "UPDATE hobbys SET URL = :URL, memo = :memo WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':URL', $URL);
$stmt->bindValue(':memo', $memo);
$stmt->bindValue(':id', $id);
$stmt->execute();
$stmt->fetch();

$delete_sql = "delete FROM hobby_tag WHERE hobby_id = :id";
$stmt = $pdo->prepare($delete_sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

#tagsへの登録処理
#複数のタグをスペースで分割する
$tag_list = preg_replace('/　/', ' ',$tag_list); //全角スペースを半角スペースへ
$tag_list = preg_replace('/\s+/', ' ', $tag_list); //連続する半角スペースを1つの半角スペースへ
//" "で区切る
$tags = explode(" ", $tag_list);
//tagの個数分登録を繰り返す

foreach ($tags as $tag) {
    //tag_idの取得
    $sql = 'SELECT * FROM tags WHERE tag=:tag';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tag', $tag);
    $stmt->execute();
    $tags_id = $stmt->fetch();

    //もしtagがDBになかったら登録する、あればスルー
    if (empty($tags_id)) {
        $sql = "INSERT INTO `tags` (`id`, `user_id`, `tag`) VALUES (NULL,  :user_id, :tag ) ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':tag', $tag);
        $stmt->execute();
        $tags_id = $pdo->lastInsertId();
    } else {
        $tags_id = $tags_id['id'];
    }

    $sql = "INSERT INTO `hobby_tag` (`id`,`hobby_id`, `tag_id`) VALUES (NULL, :hobby_id,:tag_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':hobby_id', $id );
    $sth->bindValue(':tag_id', $tags_id);
    $result2 = $sth->execute();
}


?>
<!--ここから表示-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>締め切り編集確認画面</h1>
    <p>この内容で更新しました</p>
    <p></p>
    <table>
        <tr>
            <td>URL:<?= h($URL) ?></td>
        </tr>
        <tr>
            <td>タグ:<?= h($tag_list) ?></td>
        </tr>
        <tr>
            <td>メモ:<?= h($memo) ?></td>
        </tr>
    </table>
    <!--締め切り一覧に戻るボタン-->
    <form method="POST">
        <input type='submit' name='back' value='締め切り一覧に戻る'>
    </form>

    <script src="../script.js"></script>
</body>