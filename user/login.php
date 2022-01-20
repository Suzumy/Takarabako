<?php
session_start();

if ($_SESSION) {
    if ($_SESSION['error'] == 'login_faild') {
        $login_failed = "<script type='text/javascript'>alert('ログイン失敗しました');</script>";
        echo $login_failed;
    }
}

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'true') {
        $logout_message = "<script type='text/javascript'>alert('ログアウトしました');</script>";
        echo $logout_message;
    }
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./../css/signup.css">
    <title></title>
</head>


<form method="POST" action="login_db.php" name="login_form">

    <div class="login_form_top">
        <h1>ログイン画面</h1>
        <p>メールアドレスとパスワードを入力してください</p>

    </div>

    <div class="login_form_btm">
        <input type="text" name="address" placeholder="usermail" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="ログイン">
        <button type=“button” onclick="location.href='signup.php'">新規登録</button>
    </div>

</form>