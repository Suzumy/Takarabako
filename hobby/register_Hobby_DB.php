<?php
session_start();
require_once __DIR__ . '/DB.php';
$URL = $_POST['URL'];
$tag = $_POST['tag'];
$memo = $_POST['memo'];
$userId = $_SESSION['id']; //ここにはセッションに入っているユーザーIDを入れる

$data = date("Y/m/d H:i:s");
$data2 = date("Y/m/d H:i:s");

#hobbysへの登録処理
$sql = "INSERT INTO `hobbys` (`id`, `user_id`, `URL`, `memo`, `picture`, `day_at`, `disclosure`, `created_day`, `update_day`) VALUES (NULL, :user_id, :URL, :memo, NULL, NULL, NULL, :data, :data2 )";
//sqlインクジェクション対策
$sth = $pdo->prepare($sql);
$sth->bindValue(':user_id', $userId);
$sth->bindValue(':URL', $URL);
$sth->bindValue(':memo', $memo);
$sth->bindValue(':data', $data);
$sth->bindValue(':data2', $data2);
$result1 = $sth->execute();
$hobby_id = $pdo->lastInsertId(); //挿入したレコードのidを取得

#tagsへの登録処理
#複数のタグをスペースで分割する
$tag = preg_replace('/　/', ' ', $tag); //全角スペースを半角スペースへ
$tag = preg_replace('/\s+/', ' ', $tag); //連続する半角スペースを1つの半角スペースへ
//" "で区切る
$tags = explode(" ", $tag);
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
    $sth->bindValue(':hobby_id', $hobby_id );
    $sth->bindValue(':tag_id', $tags_id);
    $result2 = $sth->execute();
}


//チェック用
if ($result2) {
    header('Location: ./hobbylist.php');
} else {
    echo '1,失敗';
}
