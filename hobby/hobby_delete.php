<?
//削除処理
require_once '../DB.php';

$hobby_id = $_POST['id'];


$sql = "DELETE  FROM hobby_tag WHERE hobby_id =:hobby_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':hobby_id', $hobby_id);
$stmt->execute();

$sql = "DELETE  FROM hobbys WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $hobby_id);
$result = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <p>削除しました</p>
</body>

</html>