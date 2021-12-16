<?php
//DB接続の処理
require_once 'DB.php';

//htmlspecialcharsの処理
require_once 'util.php';

//日付の一番近い締め切りを取得
$sql = 'select * from application_lists ORDER BY deadline ASC';
$stmt = $pdo->query($sql);
$count=$stmt->rowCount();
$result=$stmt->execute();
$list=$stmt->fetch();
//締め切りリストの要素がない場合
if($count==0){
    $alert = "<script type='text/javascript'>alert('応募期限のリストがありません');</script>";
}else{
    $time=$list['deadline'];
    $title =$list['title']; 

    $date = new DateTime($time);
    $month = $date->format('m');  
    $day = $date->format('d');  
//一番近い期限のやつを出力
    $alert = "<script type='text/javascript'>alert('".h($month)."月".h($day)."日までの". h($title). "の応募期限が近づいています');</script>";

   
}
echo $alert;
?>
