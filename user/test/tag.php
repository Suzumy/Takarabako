<?php
//DBへのアクセス
$dsn = 'mysql:host=localhost;dbname=takarabako;charset=utf8';
$user = 'treasure';
$password = 'box';

$pdo = new PDO($dsn, $user, $password);
$sql = "SELECT * FROM tags";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$all = $stmt->fetchall();

foreach($all as $value){
    echo $value['tag'];
?>
<br>
<?php    
}