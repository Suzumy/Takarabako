<?php
require_once __DIR__ . '/header.php';
?>
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
    <form action="">
        <table>
            <tr><td>題名</td><td><input type="text" name=""></td></tr>
            <tr><td>日付</td><td><input type="date" name="tag"></td></tr>
            <tr><td>時間</td><td><input type="time" name="tag"></td></tr>
            <tr><td>メモ</td><td><textarea name="memo" cols="50" rows="5"></textarea></td></tr>
            <tr><td colspan="2"><input type="submit" value="送信"></td></tr>
        </table>
    </form>
</body>
</html>



