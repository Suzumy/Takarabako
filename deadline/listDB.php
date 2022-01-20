<?php
//DB接続設定
require_once '../DB.php';

session_start();

$userId = $_SESSION['id'];

//tagがまず送られている？
if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    //プルダウンの選択が全てなら全部表示
    if ($tag == '全て') {
        $sql = "SELECT  * FROM application_lists WHERE user_id = :user_id ORDER BY application_lists.deadline";
        $stmt =  $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        $tasks = $stmt->fetchall();
        //プルダウンの文字列に該当するものだけ送信
    } else {

        //tagsテーブルのidを取得
        $sql = 'SELECT * FROM tags WHERE tag=:tag';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tag', $tag);
        $stmt->execute();
        $tags_id = $stmt->fetch();
        $tags_id = $tags_id['id'];
        $sql = 'SELECT * FROM  application_lists JOIN apl_tag ON application_lists.id=apl_tag.apl_id WHERE apl_tag.tag_id=:tags_id AND user_id = :user_id ORDER BY application_lists.deadline';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tags_id', $tags_id);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        $tasks = $stmt->fetchall();
    }
    //$tagに変数がない場合
} else {
    $sql = "SELECT  * FROM application_lists WHERE user_id = :user_id ORDER BY application_lists.deadline";
    $stmt =  $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId);
    $stmt->execute();
    $tasks = $stmt->fetchall();
}
//プルダウンにタグを渡す
$sql = "SELECT DISTINCT tag FROM tags WHERE user_id = :user_id and tag != ' '";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->execute();
$tags = $stmt->fetchall();
