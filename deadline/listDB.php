<?php
//DB接続設定
require_once '../DB.php';
//tagがまず送られている？
if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    //プルダウンの選択が全てなら全部表示
    if ($tag == '全て') {
        $sql = "SELECT  * FROM application_lists";
        $stmt =  $pdo->query($sql);
        $stmt->execute();
        $tasks = $stmt->fetchall();
        //プルダウンの文字列に該当するものだけ送信
    } else {
        //プレースホルダにするべきかも
        $sql = "SELECT  * FROM application_lists WHERE tag ='" . $tag . "'";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $tasks = $stmt->fetchall();
    }
    //$tagに変数がない場合
} else {
    $sql = "SELECT  * FROM application_lists";
    $stmt =  $pdo->query($sql);
    $stmt->execute();
    $tasks = $stmt->fetchall();
}
//プルダウンにタグを渡す
$sql = "SELECT DISTINCT * FROM tags";
$stmt = $pdo->query($sql);
$stmt->execute();
$tags = $stmt->fetchall();
