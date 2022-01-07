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
$tag_array = array(); //arrayの初期化
$tag = explode(" ", $tag); //タグの分割
foreach ($tag as $t) {
    #タグへの挿入処理
    $sql = "insert into tags (tag, user_id) values (:tag, :user_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':tag', $t, PDO::PARAM_STR);
    $sth->bindValue(':user_id', $userId, PDO::PARAM_STR);
    $result = $sth->execute();
    #hobby_tagテーブルへ挿入するための準備
    $last_tag_id = $pdo->lastInsertId();
    array_push($tag_array, $last_tag_id);
}
// $sql="INSERT INTO `tags` (`id`, `user_id`, `tag`) VALUES (NULL, '1', :tag ); ";
// $sth = $pdo -> prepare($sql);
// $sth -> bindValue(':tag' , $tag); 
// $result2=$sth -> execute();

#hobby_tagへの登録処理
//上二つ登録したidをhobby_tagテーブルへ登録する
foreach ($tag_array as $t) {
    $sql = "insert into hobby_tag (hobby_id, tag_id) values(:hobby_id, :tag_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':hobby_id', $hobby_id);
    $sth->bindValue(':tag_id', $t);
    $result = $sth->execute();
}

//チェック用
if ($result1) {
    header('Location: ./hobbylist.php');
} else {
    echo '1,失敗';
}
