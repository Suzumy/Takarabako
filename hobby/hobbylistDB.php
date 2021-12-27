<?php
//DB接続設定
require_once 'DB.php';
//tagがまず送られている？
if (isset($_POST['tag'])) {
    $hobby_tag = $_POST['tag'];
    //プルダウンの選択が全てなら全部表示
    if ($hobby_tag == '全て') {
        $sql = "SELECT tags.tag,hobbys.memo,hobbys.day_at,hobbys.id,hobbys.URL FROM hobbys 
        LEFT JOIN hobby_tag ON hobbys.id = hobby_tag.hobby_id
        LEFT JOIN tags ON hobby_tag.id = tags.id";
        $stmt =  $pdo->query($sql);
        $stmt->execute();
        $tasks = $stmt->fetchall();
        //プルダウンの文字列に該当するものだけ送信
    } else {
        //プレースホルダにするべきかも
        $sql = "SELECT tags.tag,hobbys.memo,hobbys.day_at,hobbys.id,hobbys.URL FROM hobbys 
        LEFT JOIN hobby_tag ON hobbys.id = hobby_tag.hobby_id
        LEFT JOIN tags ON hobby_tag.id = tags.id";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $tasks = $stmt->fetchall();
    }
    //$tagに変数がない場合
} else {
    $sql = "SELECT tags.tag,hobbys.memo,hobbys.day_at,hobbys.id,hobbys.URL FROM hobbys 
    LEFT JOIN hobby_tag ON hobbys.id = hobby_tag.hobby_id
    LEFT JOIN tags ON hobby_tag.id = tags.id";
    $stmt =  $pdo->query($sql);
    $stmt->execute();
    $tasks = $stmt->fetchall();
}
//プルダウンにタグを渡す
$sql = "SELECT DISTINCT * FROM tags";
$stmt = $pdo->query($sql);
$stmt->execute();
$tags = $stmt->fetchall();
