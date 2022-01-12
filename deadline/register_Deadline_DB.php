<?php

session_start();

require_once __DIR__ . '/../DB.php';
$title = $_POST['title'];
$days = $_POST['day'];
$string_tag =  $_POST['tag'];
$time = $_POST['time'];
$detail = $_POST['memo'];
$tag = $_POST['tag'];
$data = $days . ' ' . $time;
$userId = $_SESSION['id']; //本来ここはログイン時に入れるセッション変数から持ってくる


//aplistsへのレコード追加
$sql = "INSERT INTO `application_lists` (`id`, `user_id`,`title`, `deadline`, `detail`) VALUES (NULL, :user_id, :title, :data, :detail )";

#apl_tagに格納した2つのidを挿入//sqlインクジェクション対策
$sth = $pdo->prepare($sql);
$sth->bindValue(':title', $title);
$sth->bindValue(':user_id', $userId);
$sth->bindValue(':data', $data);
$sth->bindValue(':detail', $detail);
$result1 = $sth->execute();

#格納したidを取得lasrinsertid()
$apl_id = $pdo->lastInsertId();


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

  $sql = "INSERT INTO `apl_tag` (`id`,`apl_id`, `tag_id`) VALUES (NULL, :apl_id,:tag_id)";
  $sth = $pdo->prepare($sql);
  $sth->bindValue(':apl_id', $apl_id);
  $sth->bindValue(':tag_id', $tags_id);
  $result2 = $sth->execute();
}

//チェック用
if ($result2) {
  header('Location: ./list.php');
} else {
  echo '1,失敗';
}
