<?php
require_once __DIR__ . '/../DB.php';
$title = $_POST['title'];
$days = $_POST['day'];
$time = $_POST['time'];
$detail = $_POST['memo'];
$tag = $_POST['tag'];
$data = $days . ' ' . $time;

$sql = "INSERT INTO `application_lists` (`id`,`title`, `deadline`, `detail`) VALUES (NULL,:title, :data, :detail )";
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
