<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./../css/signup.css">
    <title></title>
</head>



<form method="POST" action="signup_db.php" name="login_form">

    <div class="login_form_top">
      <h1>アカウント登録画面</h1>
      
    </div>

    <div class="login_form_btm">
      <input type="text" name="address"placeholder="usermail" required>
      <input type="password" name="password"placeholder="password" required>
      <input type="text" name="username"placeholder="username" required>
      <input type="submit" value="登録">
    </div>

</form>
