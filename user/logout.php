<p>ログアウトしました。</p>
<a href="login.php">ログイン画面へ</a>

<?php
session_start();
$_SESSION = array();
session_destroy();
?>