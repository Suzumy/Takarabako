<?php
//DBへのアクセス
$dsn = 'mysql:host=localhost;dbname=takarabako;charset=utf8';
$user = 'treasure';
$password = 'box';

$pdo = new PDO($dsn, $user, $password);
$sql = "SELECT tags.tag,hobbys.memo,hobbys.day_at,hobbys.id,hobbys.URL, hobbys.user_id FROM `hobbys` INNER JOIN hobby_tag ON hobbys.id = hobby_tag.hobby_id INNER JOIN tags ON hobby_tag.tag_id = tags.id";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$all = $stmt->fetchall();

foreach($all as $value){
    echo $value['tag'];
?>
<br>
<?php    
}