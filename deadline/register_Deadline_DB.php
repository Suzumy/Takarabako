<?php
require_once __DIR__ . '/../DB.php';
$title = $_POST['title'];
$days = $_POST['day'];
$string_tag =  $_POST['tag'];
$time = $_POST['time'];
$detail = $_POST['memo'];
$tag = $_POST['tag'];
$data = $days . ' ' . $time;
$userId = 1; //本来ここはログイン時に入れるセッション変数から持ってくる


//aplistsへのレコード追加
$sql = "INSERT INTO `application_lists` (`id`, `title`, `deadline`, `detail`) VALUES (NULL, :title, :data, :detail )";
#apllistsにtitle, deadline, detailを格納
#tagsにtagを格納
#格納したidを取得lasrinsertid()
#apl_tagに格納した2つのidを挿入//sqlインクジェクション対策
$sth = $pdo->prepare($sql);
$sth->bindValue(':title', $title);
$sth->bindValue(':data', $data);
$sth->bindValue(':detail', $detail);
$result1 = $sth->execute();
#格納したidを取得lasrinsertid()
$apl_id = $pdo->lastInsertId();
//tag_idの取得
$sql = 'SELECT * FROM tags WHERE tag=:tag';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tag', $tag);
$stmt->execute();
$tags_id = $stmt->fetch();
$tags_id = $tags_id['id'];

$sql = "INSERT INTO `apl_tag` (`id`,`apl_id`, `tag_id`) VALUES (NULL, :apl_id,:apl_tag)";
$sth = $pdo->prepare($sql);

$sth->bindValue(':apl_id', $apl_id);
$sth->bindValue(':apl_tag', $tags_id);
$result2 = $sth->execute();

$last_dead_id = $pdo->lastInsertId();

//tagsテーブルへのレコード追加
//複数のタグを分ける処理
$tag_id_array = array(); //arrayの初期化
$tag = explode(" ", $string_tag);
foreach ($tag as $t) {
    $sql = "insert into tags (tag, user_id) values (:tag, :user_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':tag', $t, PDO::PARAM_STR);
    $sth->bindValue(':user_id', $userId, PDO::PARAM_STR);
    $result = $sth->execute();
    $last_tag_id = $pdo->lastInsertId();
    array_push($tag_id_array, $last_tag_id);
}


//上二つ登録したidをapl_tagテーブルへ登録する
foreach ($tag_id_array as $t) {
    $sql = "insert into apl_tag (apl_id, tag_id) values(:apl_id, :tag_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':apl_id', $last_dead_id);
    $sth->bindValue(':tag_id', $t);
    $result = $sth->execute();
}





//チェック用
if ($result1) {
    echo '1登録成功！';
} else {
    echo '1失敗';
}
if ($result2) {
    echo '2登録成功！';
} else {
    echo '2失敗';
}
