<?php
require_once __DIR__ . '/DB.php';
$URL=$_POST['URL'];
$tag=$_POST['tag'];
$memo=$_POST['memo'];
$data= date("Y/m/d H:i:s");
$data2= date("Y/m/d H:i:s");
echo $data;
echo $data2;
$sql ="INSERT INTO `hobbys` (`id`, `user_id`, `URL`, `memo`, `picture`, `day_at`, `disclosure`, `created_day`, `update_day`) VALUES (NULL, '1', ':URL', ':memo', NULL, NULL, NULL, 'data', 'data2')"; 
//sqlインクジェクション対策
$sth = $pdo -> prepare($sql);

$sth -> bindValue(':URL', $URL); 
$sth -> bindValue(':memo', $memo); 
$sth -> bindValue(':data', $data); 
$sth -> bindValue(':data2', $data2); 
$result=$sth ->execute();



//チェック用
if($data){
    echo '登録成功！';
}else{
    echo'失敗';
}
?>
