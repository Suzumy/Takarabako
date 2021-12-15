<?php
require_once __DIR__ . '/DB.php';
$title=$_POST['title'];
$days=$_POST['day'];
$time=$_POST['time'];
$detail=$_POST['memo'];
$data=$days.' '.$time;

$sql = "INSERT INTO `application_lists` (`id`, `tag`,`title`, `deadline`, `detail`) VALUES (NULL, '#',:title, :data, :detail )";
//sqlインクジェクション対策
$sth = $pdo -> prepare($sql);

$sth -> bindValue(':title', $title); 
$sth -> bindValue(':data', $data); 
$sth -> bindValue(':detail', $detail); 

$result=$sth -> execute();



//チェック用
if($result){
    echo '登録成功！';
}else{
    echo'失敗';
}
?>
