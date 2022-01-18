<?php
require_once __DIR__ . '/../header.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>趣味登録</title>
    <link rel="stylesheet" href="HP.css">
</head>


<main>
    <h1 class="font">趣味登録</h1>
    <form action="register_Hobby_DB.php" method="POST">
        <div class=form>
            <table>
                <tr>
                    <td class="txt">URL</td>
                    <td><input class="txtbox" type="text" name="URL" placeholder="URLを入力してください"></td>
                </tr>
                <tr>
                    <td>タグ</td>
                    <td><input class="txtbox" type="text" name="tag" placeholder="(例)アイドル"></td>
                </tr>
                <tr>
                    <td>メモ</td>
                    <td><textarea class="txtarea" name="memo" cols="50" rows="5"></textarea></td>
                </tr>
                
            </table>
            <input class="btn5" type="submit" value="送信">

        </div>
    </form>
</main>

<script src="../script.js"></script>

</html>