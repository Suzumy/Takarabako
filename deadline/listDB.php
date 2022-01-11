<?php
//DB接続設定
<<<<<<< HEAD

session_start();

require_once 'DB.php';

try {
    $userId = $_SESSION['id'];
} catch (Exception $e) {
    //何かの理由でセッションが切れてる場合、ログイン画面へ遷移する
    header('Location: ../user/login.php');
}
=======
require_once '../DB.php';

session_start();

$userId = $_SESSION['id'];

<<<<<<< Updated upstream
=======
>>>>>>> b6dd4a010bc0ffa3c72f109d0a05f65c6f6755ec
>>>>>>> Stashed changes
//tagがまず送られている？
if (isset($_POST['tag'])) {
    $apl_tag = $_POST['tag'];
    //プルダウンの選択が全てなら全部表示
<<<<<<< HEAD
    if (  $apl_tag  == '全て') {
        $sql = "SELECT tags.tag,application_lists.detail,application_lists.title,application_lists.deadline,application_lists.id,application_lists.user_id FROM `application_lists` 
        INNER JOIN apl_tag ON application_lists.id = apl_tag.apl_id 
        INNER JOIN tags ON apl_tag.tag_id = tags.id WHERE application_lists.user_id = :user_id";
=======
    if ($tag == '全て') {
        $sql = "SELECT  * FROM application_lists WHERE user_id = :user_id";
<<<<<<< Updated upstream
=======
>>>>>>> b6dd4a010bc0ffa3c72f109d0a05f65c6f6755ec
>>>>>>> Stashed changes
        $stmt =  $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        $tasks = $stmt->fetchall();
        //プルダウンの文字列に該当するものだけ送信
    } else {
<<<<<<< HEAD
        //プレースホルダにするべきかも
        //tagを確認
        $sql = "SELECT tags.tag,application_lists.detail,application_lists.title,application_lists.deadline,application_lists.id,application_lists.user_id FROM `application_lists` 
        INNER JOIN apl_tag ON application_lists.id = apl_tag.apl_id 
        INNER JOIN tags ON apl_tag.tag_id = tags.id WHERE application_lists.user_id = :user_id AND tags.tag=:tags_tag";
        $stmt =  $pdo->prepare($sql);
        $stmt->bindValue(':tags_tag', $apl_tag);
=======

        //tagsテーブルのidを取得
        $sql = 'SELECT * FROM tags WHERE tag=:tag';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tag', $tag);
        $stmt->execute();
        $tags_id = $stmt->fetch();
        $tags_id = $tags_id['id'];
        $sql = 'SELECT * FROM  application_lists JOIN apl_tag ON application_lists.id=apl_tag.apl_id WHERE apl_tag.tag_id=:tags_id AND user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tags_id', $tags_id);
<<<<<<< Updated upstream
=======
>>>>>>> b6dd4a010bc0ffa3c72f109d0a05f65c6f6755ec
>>>>>>> Stashed changes
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        $tasks = $stmt->fetchall();
    }
    //$tagに変数がない場合
} else {
<<<<<<< Updated upstream
    $sql = "SELECT  * FROM application_lists WHERE user_id = :user_id";
=======
<<<<<<< HEAD
    $sql = "SELECT tags.tag,application_lists.detail,application_lists.title,application_lists.deadline,application_lists.id,application_lists.user_id FROM `application_lists` 
    INNER JOIN apl_tag ON application_lists.id = apl_tag.apl_id 
    INNER JOIN tags ON apl_tag.tag_id = tags.id WHERE application_lists.user_id = :user_id";
=======
    $sql = "SELECT  * FROM application_lists WHERE user_id = :user_id";
>>>>>>> b6dd4a010bc0ffa3c72f109d0a05f65c6f6755ec
>>>>>>> Stashed changes
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
