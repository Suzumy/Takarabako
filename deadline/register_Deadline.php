<?php
require_once __DIR__ . '/../header.php';
require_once __DIR__ . '/../util.php';
//DB接続設定
require_once '../DB.php';

$sql = "SELECT DISTINCT * FROM tags";
$stmt = $pdo->query($sql);
$stmt->execute();
$tags = $stmt->fetchall();

?>
//このファイルにphpの処理を足して登録・編集を兼用できるようにしたい
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
    <link rel="stylesheet" href="HP.css">
</head>


<body>
    <p class="font1">締め切り登録</p>
    <form action="register_Deadline_DB.php" method="POST">
        <table>
            <tr>
                <td>題名</td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td>日付</td>
                <td><input type="date" name="day"></td>
            </tr>
            <tr>
                <td>タグ</td>
                <td><input type="text" name="tag"></td>
            </tr>
            <tr>
                <td>時間</td>
                <td><input type="time" name="time"></td>
            </tr>
            <tr>
                <td>メモ</td>
                <td><textarea name="memo" cols="50" rows="5"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="送信"></td>
            </tr>
        </table>
    </form>
</body>

<script src="../script.js"></script>

</html>