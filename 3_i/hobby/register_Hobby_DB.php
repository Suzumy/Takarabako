<?php
require_once __DIR__ . '/DB.php';
$URL=$_POST['URL'];
$tag=$_POST['tag'];
$memo=$_POST['memo'];

$data= date("Y/m/d H:i:s");
$data2= date("Y/m/d H:i:s");

$sql= "INSERT INTO `hobbys` (`id`, `user_id`, `URL`, `memo`, `picture`, `day_at`, `disclosure`, `created_day`, `update_day`) VALUES (NULL, '1', :URL, :memo, NULL, NULL, NULL, :data, :data2 )"; 
//sqlインクジェクション対策
$sth = $pdo -> prepare($sql);

$sth -> bindValue(':URL', $URL); 
$sth -> bindValue(':memo', $memo); 

$sth -> bindValue(':data', $data); 
$sth -> bindValue(':data2', $data2); 
$result1=$sth -> execute();

$sql="INSERT INTO `tags` (`id`, `user_id`, `tag`) VALUES (NULL, '1', :tag ); ";
$sth = $pdo -> prepare($sql);
$sth -> bindValue(':tag' , $tag); 
$result2=$sth -> execute();

//チェック用
if($result1){
    echo '1,登録成功！';
}else{
    echo'1,失敗';
}
if($result2){
    echo '2,登録成功！';
}else{
    echo'2,失敗';
}
?>
